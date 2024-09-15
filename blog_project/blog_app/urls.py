from django.urls import path

from .views import PostListView, PostDetailView, PostCreate

app_name = "blog_app"

urlpatterns = [
    path("", PostListView.as_view(), name="post-list"),
    path("posts/create/", PostCreate.as_view(), name="post-create"),
    path("posts/<slug:slug>/", PostDetailView.as_view(), name="post-detail"),
]
