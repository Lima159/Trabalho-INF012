from django.urls import path
#from biblioteca import views
from rest_framework.urlpatterns import format_suffix_patterns
from . import views

urlpatterns = [
    path('biblioteca/', views.BookList.as_view()),
    #path('biblioteca/str:pk/', views.BookDetail.as_view()),
    path('usuarios/', views.UserList.as_view()),
    path('sessoes/', views.SessionList.as_view()),
    path('emprestimos/', views.LoanList.as_view()),
    #path('biblioteca/<int:pk>/', views.BookDetail.as_view()),
]
