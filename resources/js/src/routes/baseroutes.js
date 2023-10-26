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
    {
        path: '/categories/',
        name: 'auth.categories',
        component: () => import('../views/Category/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/Category/List.vue'),
                name: 'auth.categories.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/Category/Form.vue'),
                name: 'auth.categories.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/Category/Form.vue'),
                name: 'auth.categories.edit'
            }
        ],
    },
    {
        path: '/case-categories/',
        name: 'auth.casecategories',
        component: () => import('../views/CaseCategory/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/CaseCategory/List.vue'),
                name: 'auth.casecategories.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/CaseCategory/Form.vue'),
                name: 'auth.casecategories.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/CaseCategory/Form.vue'),
                name: 'auth.casecategories.edit'
            }
        ],
    },
    {
        path: '/blogs/',
        name: 'auth.blogs',
        component: () => import('../views/Blog/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/Blog/List.vue'),
                name: 'auth.blogs.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/Blog/Form.vue'),
                name: 'auth.blogs.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/Blog/Form.vue'),
                name: 'auth.blogs.edit'
            }
        ],
    },
    {
        path: '/faqs/',
        name: 'auth.faqs',
        component: () => import('../views/FAQ/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/FAQ/List.vue'),
                name: 'auth.faqs.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/FAQ/Form.vue'),
                name: 'auth.faqs.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/FAQ/Form.vue'),
                name: 'auth.faqs.edit'
            }
        ],
    },
    {
        path: '/feedbacks/',
        name: 'auth.feedbacks',
        component: () => import('../views/Feedback/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/Feedback/List.vue'),
                name: 'auth.feedbacks.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/Feedback/Form.vue'),
                name: 'auth.feedbacks.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/Feedback/Form.vue'),
                name: 'auth.feedbacks.edit'
            }
        ],
    },
    {
        path: '/services/',
        name: 'auth.services',
        component: () => import('../views/Services/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/Services/List.vue'),
                name: 'auth.services.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/Services/Form.vue'),
                name: 'auth.services.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/Services/Form.vue'),
                name: 'auth.services.edit'
            }
        ],
    },
    {
        path: '/chooseus/',
        name: 'auth.chooseus',
        component: () => import('../views/ChooseUs/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/ChooseUs/List.vue'),
                name: 'auth.chooseus.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/ChooseUs/Form.vue'),
                name: 'auth.chooseus.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/ChooseUs/Form.vue'),
                name: 'auth.chooseus.edit'
            }
        ],
    },
    {
        path: '/additional-services/',
        name: 'auth.additional',
        component: () => import('../views/AdditionalServices/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/AdditionalServices/List.vue'),
                name: 'auth.additional.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/AdditionalServices/Form.vue'),
                name: 'auth.additional.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/AdditionalServices/Form.vue'),
                name: 'auth.additional.edit'
            }
        ],
    },
    {
        path: '/contacts/',
        name: 'auth.contacts',
        component: () => import('../views/Contact/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/Contact/List.vue'),
                name: 'auth.contacts.listing'
            },
        ],
    },
    {
        path: '/events/',
        name: 'auth.events',
        component: () => import('../views/Event/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/Event/List.vue'),
                name: 'auth.events.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/Event/Form.vue'),
                name: 'auth.events.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/Event/Form.vue'),
                name: 'auth.events.edit'
            }
        ],
    },
    {
        path: '/case-studies/',
        name: 'auth.cases',
        component: () => import('../views/CaseStudy/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/CaseStudy/List.vue'),
                name: 'auth.cases.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/CaseStudy/Form.vue'),
                name: 'auth.cases.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/CaseStudy/Form.vue'),
                name: 'auth.cases.edit'
            }
        ],
    },
    {
        path: '/survey/',
        name: 'auth.surveys',
        component: () => import('../views/Surveys/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/Surveys/List.vue'),
                name: 'auth.surveys.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/Surveys/Form.vue'),
                name: 'auth.surveys.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/Surveys/Form.vue'),
                name: 'auth.surveys.edit'
            }
        ],
    },
    {
        path: '/survey-answers/',
        name: 'auth.surveyanswers',
        component: () => import('../views/SurveyAnswer/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/SurveyAnswer/List.vue'),
                name: 'auth.surveyanswers.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/SurveyAnswer/Form.vue'),
                name: 'auth.surveyanswers.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/SurveyAnswer/Form.vue'),
                name: 'auth.surveyanswers.edit'
            }
        ],
    },
    {
        path: '/survey-questions/',
        name: 'auth.surveyquestions',
        component: () => import('../views/SurveyQuestion/Main.vue'),
        children: [
            {
                path: '',
                component: () => import('../views/SurveyQuestion/List.vue'),
                name: 'auth.surveyquestions.listing'
            },
            {
                path: 'add',
                component: () => import('@/views/SurveyQuestion/Form.vue'),
                name: 'auth.surveyquestions.add'
            },
            {
                path: 'edit/:id',
                component: () => import('@/views/SurveyQuestion/Form.vue'),
                name: 'auth.surveyquestions.edit'
            }
        ],
    },
]