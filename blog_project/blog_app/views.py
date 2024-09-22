from ipware import get_client_ip
from django.contrib.auth.mixins import LoginRequiredMixin, PermissionRequiredMixin
from django.urls import reverse_lazy
from django.views import View
from django.views.generic import (
    ListView,
    DetailView,
    CreateView,
    DeleteView,
    UpdateView,
    FormView,
)
from django.views.generic.edit import FormMixin

from .forms import PostCreateUpdateForm, CommentCreateUpdateForm
from .models import Post, Comment, PostViews


def get_user_ip(request):
    client_ip, is_routable = get_client_ip(request)

    return client_ip


class PostListView(ListView):
    model = Post


class PostDisplayView(FormMixin, DetailView):
    model = Post
    form_class = CommentCreateUpdateForm

    def get_object(self, queryset=None):
        obj = super().get_object()
        client_ip = get_user_ip(self.request)
        if not PostViews.objects.filter(post_id=obj.pk).filter(ip_address=client_ip):
            PostViews.objects.create(post_id=obj.pk, ip_address=client_ip)

        return obj

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["comments"] = self.object.comments.all()
        context["views"] = self.object.views.all()

        return context


class PostCommentView(LoginRequiredMixin, FormView):
    form_class = CommentCreateUpdateForm
    template_name = "blog_app/post_detail.html"

    def form_valid(self, form):
        form.instance.author = self.request.user
        post = Post.objects.get(slug=self.kwargs["slug"])
        form.instance.post = post
        form.save()
        return super().form_valid(form)

    def get_success_url(self):
        return reverse_lazy(
            "blog_app:post-detail", kwargs={"slug": self.kwargs["slug"]}
        )


class PostDetailView(View):
    def get(self, request, *args, **kwargs):
        view = PostDisplayView.as_view()
        return view(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        view = PostCommentView.as_view()
        return view(request, *args, **kwargs)


class PostCreateView(LoginRequiredMixin, CreateView):
    model = Post
    form_class = PostCreateUpdateForm
    template_name = "blog_app/post_create.html"
    success_url = "/"

    def form_valid(self, form):
        form.instance.author = self.request.user
        return super().form_valid(form)


class PostDeleteView(PermissionRequiredMixin, DeleteView):
    model = Post
    success_url = "/"
    permission_required = "delete_post"


class PostUpdateView(PermissionRequiredMixin, UpdateView):
    model = Post
    form_class = PostCreateUpdateForm
    template_name = "blog_app/post_edit.html"
    success_url = "/"
    permission_required = "change_post"


class CommentDeleteView(PermissionRequiredMixin, DeleteView):
    model = Comment
    permission_required = "delete_comment"

    def get_success_url(self):
        return reverse_lazy(
            "blog_app:post-detail", kwargs={"slug": self.kwargs["slug"]}
        )


class CommentUpdateView(PermissionRequiredMixin, UpdateView):
    model = Comment
    form_class = CommentCreateUpdateForm
    template_name = "blog_app/comment_edit.html"
    permission_required = "change_comment"

    def get_success_url(self):
        return reverse_lazy(
            "blog_app:post-detail", kwargs={"slug": self.kwargs["slug"]}
        )
