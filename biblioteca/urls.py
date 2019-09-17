from django.urls import path
from biblioteca import views

urlpatterns = [
    path('biblioteca/', views.book_list),
    path('biblioteca/<int:pk>/', views.book_detail),
]