from rest_framework import serializers
from .models import *

class BookSerializer(serializers.ModelSerializer):
	class Meta:
		model = Book
		fields = ['code','title','author','session_code']

class UserSerializer(serializers.ModelSerializer):
	class Meta:
		model = CustomUser
		fields = ['username','password','user_registration','adress','tel']
