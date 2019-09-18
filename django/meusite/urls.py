from django.contrib import admin
from django.urls import path
from django.urls import path, include
from rest_framework.authtoken.views import obtain_auth_token

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('biblioteca.urls')),
    path('api-token-auth/', obtain_auth_token, name='api-token-auth'),
]
