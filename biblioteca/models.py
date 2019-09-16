from django.conf import settings
from django.db import models
from django.utils import timezone
from django.contrib.auth.models import User

class User(models.Model):
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    user_registration = models.CharField(max_length=30, primary_key=True) #matricula
    adress = models.TextField(max_length=200)           #endereco
    tel = models.IntegerField()                         #telefone

class Book(models.Model):
    code = models.CharField(max_length=30, primary_key=True)
    title = models.CharField(max_length=200)
    author = models.CharField(max_length=50)
    session_code = models.CharField(max_length=30)

class Session(models.Model):
    code = models.CharField(max_length=30 ,primary_key=True)
    details = models.CharField(max_length=100)
    location = models.CharField(max_length=100)

class Loan(models.Model):
    #code = models.ForeignKey(Book, to_field='code')
    code = models.CharField(max_length=30, primary_key=True)
    date_time = models.DateTimeField(default=timezone.now)
    devolution_date = models.DateField()
    user_registration = models.ForeignKey(User, to_field="user_registration",on_delete=models.PROTECT)

class Book_Loan(models.Model):
    book_code = models.ForeignKey(Book, to_field='code', on_delete=models.PROTECT)
    loan_code = models.ForeignKey(Loan, to_field='code', on_delete=models.PROTECT)
