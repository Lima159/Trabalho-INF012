from django.conf import settings
from django.db import models
from django.utils import timezone
from django.contrib.auth.models import User
from django.contrib.auth.models import AbstractUser
from django.db.models.signals import post_save
from django.dispatch import receiver
from rest_framework.authtoken.models import Token
from django.contrib.auth import get_user_model


@receiver(post_save, sender=settings.AUTH_USER_MODEL)
def create_auth_token(sender, instance=None, created=False, **kwargs):
    if created:
        Token.objects.create(user=instance)

#problema na geração automatica esta por aqui
class CustomUser(AbstractUser):
    user_registration = models.CharField(max_length=30, primary_key=True) #matricula
    adress = models.TextField(max_length=200)           #endereco
    tel = models.CharField(max_length=30)                         #telefone

    def __str__(self):
        return self.username

class Session(models.Model):
    code = models.CharField(max_length=30 ,primary_key=True)
    details = models.CharField(max_length=100)
    location = models.CharField(max_length=100)

    def __str__(self):
        return self.code

class Book(models.Model):
    code = models.CharField(max_length=30, primary_key=True)
    title = models.CharField(max_length=200)
    author = models.CharField(max_length=50)
    session_code = models.ForeignKey(Session , to_field="code",on_delete=models.PROTECT)

    def __str__(self):
        return self.title

class Loan(models.Model):
    code = models.CharField(max_length=30, primary_key=True)
    date_time = models.DateTimeField(default=timezone.now)
    devolution_date = models.DateField()
    user_registration = models.ForeignKey(CustomUser, to_field="user_registration",on_delete=models.PROTECT)

    def __str__(self):
        return self.code

class Book_Loan(models.Model):
    book_code = models.ForeignKey(Book, to_field='code', on_delete=models.PROTECT)
    loan_code = models.ForeignKey(Loan, to_field='code', on_delete=models.PROTECT)

    def __str__(self):
        code = 'B:' + self.book_code.code + '  L:' + self.loan_code.code
        return code
