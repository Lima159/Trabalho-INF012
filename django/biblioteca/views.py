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

class BookDetail(APIView):

	def get_object(self, pk):
		try:
			return Book.objects.get(pk=pk)
		except Book.DoesNotExist:
			raise Http404
	
	def get(self, request, pk, format=None):
		book = self.get_object(pk)
		return Response( BookSerializer(book).data )

	def put(self, request, pk, format=None):
		book = self.get_object(pk)
		serializer = BookSerializer(book, data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(serializer.data)
		return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

	def delete(self, request, pk, format=None):
		book = self.get_object(pk)
		book.delete()
		return Response(status=status.HTTP_204_NO_CONTENT)

class UserList(APIView):
	permissions_class = (IsAuthenticated, )
	def get(self, request, format = None):
		users = CustomUser.objects.all()
		serializer = UserSerializer(users, many = True)
		return JsonResponse(serializer.data, safe = False)

	def post(self, request, format = None):
		data = JSONParser().parse(request)
		usuario = {
		"username": data['username'],
		"password": make_password(data['password']),
		"email": data['email'],
		"user_registration": data['user_registration'],
		"adress": data['adress'],
		"tel": data['tel']
		}
		serializer = UserSerializer(data = usuario)
		if serializer.is_valid():
			serializer.save()
			return JsonResponse(serializer.data, status = 201, safe=False)
		return JsonResponse(serializer, status = 400)

class UserDetail(APIView):
	def get_object(self, pk):
		try:
			return CustomUser.objects.get(pk=pk)
		except CustomUser.DoesNotExist:
			raise Http404
	
	def get(self, request, pk, format=None):
		user = self.get_object(pk)
		return Response( UserSerializer(user).data )

	def put(self, request, pk, format=None):
		user = self.get_object(pk)
		serializer = UserSerializer(user, data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(serializer.data)
		return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

	def delete(self, request, pk, format=None):
		user = self.get_object(pk)
		user.delete()
		return Response(status=status.HTTP_204_NO_CONTENT)

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

class SessionDetail(APIView):
	def get_object(self, pk):
		try:
			return Session.objects.get(pk=pk)
		except Session.DoesNotExist:
			raise Http404
	
	def get(self, request, pk, format=None):
		session = self.get_object(pk)
		return Response( SessionSerializer(session).data )

	def put(self, request, pk, format=None):
		session = self.get_object(pk)
		serializer = SessionSerializer(session, data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(serializer.data)
		return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

	def delete(self, request, pk, format=None):
		session = self.get_object(pk)
		session.delete()
		return Response(status=status.HTTP_204_NO_CONTENT)

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

class LoanDetail(APIView):
	def get_object(self, pk):
		try:
			return Loan.objects.get(pk=pk)
		except Loan.DoesNotExist:
			raise Http404
	
	def get(self, request, pk, format=None):
		loan = self.get_object(pk)
		return Response( LoanSerializer(loan).data )

	def put(self, request, pk, format=None):
		loan = self.get_object(pk)
		serializer = LoanSerializer(loan, data=request.data)
		if serializer.is_valid():
			serializer.save()
			return Response(serializer.data)
		return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

	def delete(self, request, pk, format=None):
		loan = self.get_object(pk)
		loan.delete()
		return Response(status=status.HTTP_204_NO_CONTENT)

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
