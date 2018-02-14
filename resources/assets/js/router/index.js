import Vue from 'vue';
import VueRouter from 'vue-router';

import IndexRoute from '../components/routes/index';
import TestRoute from '../components/routes/test';
import ErrorRoute from '../components/routes/404';
import UserRoute from '../components/routes/user';
import OfferRoute from '../components/routes/offer';
import SearchRoute from '../components/routes/search';

import OfferFormRoute from '../components/routes/offer-form';

import LoginRoute from '../components/routes/auth/login';
import RegisterRoute from '../components/routes/auth/register';
import PasswordEmailRoute from '../components/routes/auth/password-email';
import PasswordResetRoute from '../components/routes/auth/password-reset';

import UserNavigation from 'JS/components/routes/navigation/user-navigation';

import GuestGuard from './guards/guest';
import AuthGuard from './guards/auth';

import OfferModal from '../components/routes/modal/offer-modal';

import store from 'JS/store';

Vue.use(VueRouter);

const cachedRouteComponents = [
    'search-route'
];

export const cached = (suffix = '') => suffix ? cachedRouteComponents.map((route) => `${route}-${suffix}`) : cachedRouteComponents;

export const events = new Vue();

export const queryRouter = {
    offer: {
        component: OfferModal,
        size: 'xl'
    }
};

const router = new VueRouter({
    mode: 'history',
    scrollBehavior(to, from, savedPosition) {

        const promise = to.meta.async ?
            new Promise(resolve => events.$once('loaded', resolve))
            : Promise.resolve();

        if (savedPosition) {
            return promise.then(() => savedPosition);
        }

        return undefined;
    },
    routes: [
        // Index page
        {
            path: '/',
            name: 'index',
            component: IndexRoute
        },

        // Test page TODO remove
        {
            path: '/test',
            name: 'test',
            component: TestRoute,
            props: true
        },

        // Auth pages
        {
            path: '/login',
            name: 'login',
            component: LoginRoute,
            ...GuestGuard
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterRoute,
            ...GuestGuard
        },
        {
            path: '/password/reset',
            name: 'password-email',
            component: PasswordEmailRoute,
            ...GuestGuard
        },
        {
            path: '/password/reset/:token',
            name: 'password-reset',
            component: PasswordResetRoute,
            props: true,
            ...GuestGuard
        },

        // Display pages
        {
            path: '/user/:username',
            name: 'user',
            components: {
                default: UserRoute,
                navigation: UserNavigation,
            },
            props: {
                default: true
            },
            meta: {
                async: true
            }
        },
        {
            path: '/me',
            name: 'me',
            redirect: to => {
                if (store.state.is_authenticated && store.state.user)
                    return {name: 'user', params: {username: store.state.user.username}};
                else
                    return {name: 'login'}
            },
            ...AuthGuard
        },
        {
            path: '/offer/:id(\\d+)',
            name: 'offer',
            component: OfferRoute,
            props: route => ({id: parseInt(route.params.id)}),
        },
        {
            path: '/search/:query?',
            name: 'search',
            component: SearchRoute,
            props: true
        },

        // Modify pages
        {
            path: '/offer/create',
            name: 'offer-create',
            component: OfferFormRoute,
            ...AuthGuard
        },

        // error
        {
            path: '/404',
            name: 'error',
            component: ErrorRoute
        },
        {
            path: '*',
            component: ErrorRoute
        },
    ]
});

router.afterEach(() => {
    store.commit('addReRoute');
});

router.getRouteMainComponent = (route = router.currentRoute) => {
    const matched = route.matched;
    return matched[matched.length - 1].instances.default;
};

router.routesMatch = (route1, route2 = router.currentRoute, ignoreParams = false) => {
    if (!route1 || !route2)
        return false;

    if (route1.path === route2.path)
        return true;

    if (route1.name !== route2.name)
        return false;

    if (ignoreParams)
        return true;

    let match = true;
    for (let [key, param] of Object.entries(route2.params)) {
        match = match && route1.params[key] === param;
        if (!match) break;
    }

    return match;
};

export default router;