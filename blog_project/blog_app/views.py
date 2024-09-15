from django.contrib.auth.mixins import LoginRequiredMixin
from django.views.generic import ListView, DetailView, CreateView

from .forms import PostCreateUpdateForm
from .models import Post


class PostListView(ListView):
    model = Post


class PostDetailView(DetailView):
    model = Post

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["comments"] = self.object.comments.all()

        return context


class PostCreate(LoginRequiredMixin, CreateView):
    model = Post
    form_class = PostCreateUpdateForm
    template_name = "blog_app/post_create.html"
    success_url = "/"

    def form_valid(self, form):
        form.instance.author = self.request.user
        return super().form_valid(form)
