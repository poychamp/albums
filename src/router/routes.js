
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') },
      { path: '/albums/:id', component: () => import('pages/Albums/AlbumSingle.vue'), name: 'albums.single' },
      { path: '/photos/:id', component: () => import('pages/Photos/PhotoShow.vue'), name: 'photos.show' }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
