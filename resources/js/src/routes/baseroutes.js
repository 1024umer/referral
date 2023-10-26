import { defineAsyncComponent } from 'vue'
export default [
    {
        path: '/dashboard',
        name: 'auth.panel',
        component: () => import('@/views/Panel.vue'),
    },
    {
        path: '/users/',
        name: 'auth.users',
        component: () => import('../views/User/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/User/List.vue'),
                name: 'auth.users.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/User/Form.vue'),
                name: 'auth.users.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/User/Form.vue'),
                name: 'auth.users.edit'
            }
        ],
    },
    
]