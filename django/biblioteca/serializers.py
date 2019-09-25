from rest_framework import serializers
from .models import *

class BookSerializer(serializers.ModelSerializer):
	class Meta:
		model = Book
		fields = ['code','title','author','session_code']

class UserSerializer(serializers.ModelSerializer):
	class Meta:
		model = CustomUser
		fields = ['username','password','email','user_registration','adress','tel']

class SessionSerializer(serializers.ModelSerializer):
	class Meta:
		model = Session
		fields = ['code','details','location']

class LoanSerializer(serializers.ModelSerializer):
	class Meta:
		model = Loan
		fields = ['code','date_time','devolution_date','user_registration']
