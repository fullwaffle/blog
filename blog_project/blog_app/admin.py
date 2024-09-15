from django.contrib import admin

from .models import Post, Comment


class CommentTabularInline(admin.TabularInline):
    model = Comment


@admin.register(Post)
class PostAdmin(admin.ModelAdmin):
    inlines = [CommentTabularInline]
    prepopulated_fields = {"slug": ("title", )}
    list_display = "id", "title", "created_on"
    list_display_links = "id", "title"


@admin.register(Comment)
class CommentAdmin(admin.ModelAdmin):
    list_display = "id", "author", "post", "content"
    list_display_links = "id", "content"
