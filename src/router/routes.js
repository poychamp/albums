
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue'), name: 'index' },
      { path: '/albums/:id', component: () => import('pages/Albums/AlbumSingle.vue'), name: 'albums.single' },
      { path: '/photos/:id/edit', component: () => import('pages/Photos/PhotoEdit.vue'), name: 'photos.edit' },
      { path: '/photos/:id', component: () => import('pages/Photos/PhotoShow.vue'), name: 'photos.show' },
      { path: '/users/', component: () => import('pages/Users/UsersIndex.vue'), name: 'users.index' }
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
