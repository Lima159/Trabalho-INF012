from django.contrib import admin
from django.contrib.auth import get_user_model
from django.contrib.auth.admin import UserAdmin
from .forms import CustomUserCreationForm, CustomUserChangeForm
from .models import *

class CustomUserAdmin(UserAdmin):
    add_form = CustomUserCreationForm
    form = CustomUserChangeForm
    model = CustomUser
    list_display = ['email', 'username',]
    add_fieldsets=(
        (None,{
                "classes":("wide",),
                "fields":("username","password","password_validation","user_registration","adress","tel")
                },
        ),
    )

admin.site.register(CustomUser, CustomUserAdmin)
admin.site.register(Book)
admin.site.register(Session)
admin.site.register(Loan)
admin.site.register(Book_Loan)
