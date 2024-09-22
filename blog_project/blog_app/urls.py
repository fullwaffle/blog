from django.urls import path

from .views import (
    PostListView,
    PostDetailView,
    PostCreateView,
    PostDeleteView,
    PostUpdateView,
    CommentDeleteView,
    CommentUpdateView,
)

app_name = "blog_app"

urlpatterns = [
    path("", PostListView.as_view(), name="post-list"),
    path("posts/create/", PostCreateView.as_view(), name="post-create"),
    path(
        "posts/<slug:slug>/comment/<int:pk>/delete",
        CommentDeleteView.as_view(),
        name="comment-delete",
    ),
    path(
        "posts/<slug:slug>/comment/<int:pk>/update",
        CommentUpdateView.as_view(),
        name="comment-update",
    ),
    path("posts/<slug:slug>/delete", PostDeleteView.as_view(), name="post-delete"),
    path("posts/<slug:slug>/update", PostUpdateView.as_view(), name="post-update"),
    path("posts/<slug:slug>/", PostDetailView.as_view(), name="post-detail"),
]
