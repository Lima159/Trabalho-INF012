from django.shortcuts import render
from django.http import HttpResponse, JsonResponse
from django.views.decorators.csrf import csrf_exempt
from rest_framework.parsers import JSONParser
from .models import *
from .serializers import *
from rest_framework.permissions import IsAuthenticated
from rest_framework.response import Response
from rest_framework.views import APIView
from django.http import Http404
from rest_framework import status
from django.contrib.auth.hashers import make_password

class BookList(APIView):
	permissions_class = (IsAuthenticated, )
	def get(self, request, format = None):
		books = Book.objects.all()
		serializer = BookSerializer(books, many = True)
		return JsonResponse(serializer.data, safe = False)

	def post(self, request, format = None):
		data = JSONParser().parse(request)
		serializer = BookSerializer(data = data)
		if serializer.is_valid():
			serializer.save()
			return JsonResponse(serializer.data, status = 201)
		return JsonResponse(serializer, status = 400)
"""
class BookDetail(APIView):
	def get_object(self, pk):
        try:
            return Book.objects.get(pk=pk)
        except Book.DoesNotExist:
            raise Http404

    def get(self, request, pk, format=None):
        book = self.get_object(pk)
        serializer = PersonSerializer(book)
        return Response(serializer.data)

    def put(self, request, pk, format=None):
        book = self.get_object(pk)
        serializer = PersonSerializer(book, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

    def delete(self, request, pk, format=None):
        book = self.get_object(pk)
        book.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)
"""
class UserList(APIView):
	permissions_class = (IsAuthenticated, )
	def get(self, request, format = None):
		users = CustomUser.objects.all()
		serializer = UserSerializer(users, many = True)
		return JsonResponse(serializer.data, safe = False)

	def post(self, request, format = None):
		data = JSONParser().parse(request)
		usuario = CustomUser.objects.create(
			username=data['username'],
			password=make_password(data['password']),
			email=data['email'],
			user_registration=data['user_registration'],
			adress=data['adress'],
			tel=data['tel']
		)
		serializer = UserSerializer(data = usuario)
		if serializer.is_valid():
			serializer.save()
			return JsonResponse(serializer.data, status = 201)
		return JsonResponse(serializer, status = 400)

class SessionList(APIView):
	permissions_class = (IsAuthenticated, )
	def get(self, request, format = None):
		sessions = Session.objects.all()
		serializer = SessionSerializer(sessions, many = True)
		return JsonResponse(serializer.data, safe = False)

	def post(self, request, format = None):
		data = JSONParser().parse(request)
		serializer = SessionSerializer(data = data)
		if serializer.is_valid():
			serializer.save()
			return JsonResponse(serializer.data, status = 201)
		return JsonResponse(serializer, status = 400)

class LoanList(APIView):
	permissions_class = (IsAuthenticated, )
	def get(self, request, format = None):
		loans = Loan.objects.all()
		serializer = LoanSerializer(loans, many = True)
		return JsonResponse(serializer.data, safe = False)

	def post(self, request, format = None):
		data = JSONParser().parse(request)
		serializer = LoanSerializer(data = data)
		if serializer.is_valid():
			serializer.save()
			return JsonResponse(serializer.data, status = 201)
		return JsonResponse(serializer, status = 400)

"""
class BookDetail(APIView):
	permissions_class = (IsAuthenticated, )
	def book_detail(request, pk):
		try:
			book = Book.objects.get(pk=pk)
		except Book.DoesNotExist:
			return HttpResponse(status=404)

		if request.method == 'GET':
			serializer = BookSerializer(book)
			return JsonResponse(serializer.data)
		elif request.method == 'PUT':
			data = JSONParser().parse(request)
			serializer = BookSerializer(book, data = data)
			if serializer.is_valid:
				serializer.save()
				return JsonResponse(serializer.data)
			return JsonResponse(serializer.errors, status = 400)
		elif request.method == 'DELETE':
			book.delete()
			return HttpResponse(status = 204)
"""
