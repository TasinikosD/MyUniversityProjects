from struct import *
import socket
import ctypes
import numpy as np
serverIP = ''
serverPort = 12345
close = False
with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as serverSocket:
    serverSocket.bind((serverIP, serverPort))
    print ("The server is ready to receive at port", str(serverPort))
    serverSocket.listen()
    while not close:
        conn, addr = serverSocket.accept()
        print("Connected by:", addr)
        print("Server Socket port: ", conn.getsockname())
        print("Client Socket port: ", conn.getpeername())
        msg = conn.recv(4)
        msg_type,message_length = unpack_from('!HH', msg, 0)
        print('Total message length=',int(message_length))
        rest_of_msg = conn.recv(message_length-4)
        if msg_type==0:
            if message_length<12 or message_length>28:
                a,b=unpack_from('!HH',rest_of_msg,0)
                newArray=[]
            if message_length==12:
                a,b,c1,c2=unpack_from('!HHhh',rest_of_msg,0)
                newArray=[c1,c2]
            if message_length==14:
                a,b,c1,c2,c3=unpack_from('!HHhhh',rest_of_msg,0)
                newArray=[c1,c2,c3]
            if message_length==16:
                a,b,c1,c2,c3,c4=unpack_from('!HHhhhh',rest_of_msg,0)
                newArray=[c1,c2,c3,c4]
            if message_length==18:
                a,b,c1,c2,c3,c4,c5=unpack_from('!HHhhhhh',rest_of_msg,0)
                newArray=[c1,c2,c3,c4,c5]
            if message_length==20:
                a,b,c1,c2,c3,c4,c5,c6=unpack_from('!HHhhhhhh',rest_of_msg,0)
                newArray=[c1,c2,c3,c4,c5,c6]
            if message_length==22:
                a,b,c1,c2,c3,c4,c5,c6,c7=unpack_from('!HHhhhhhhh',rest_of_msg,0)
                newArray=[c1,c2,c3,c4,c5,c6,c7]
            if message_length==24:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8=unpack_from('!HHhhhhhhhh',rest_of_msg,0)
                newArray=[c1,c2,c3,c4,c5,c6,c7,c8]
            if message_length==26:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8,c9=unpack_from('!HHhhhhhhhhh',rest_of_msg,0)
                newArray=[c1,c2,c3,c4,c5,c6,c7,c8,c9]
            if message_length==28:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10=unpack_from('!HHhhhhhhhhhh',rest_of_msg,0)
                newArray=[c1,c2,c3,c4,c5,c6,c7,c8,c9,c10]
        else:
            if message_length<24 or message_length>88:
                a,b=unpack_from('!HH',rest_of_msg,0)
                newArray1=[]
                newArray2=[]
            if message_length==24:
                a,b,c1,c2,c3,c4=unpack_from('!HHiiii',rest_of_msg,0)
                newArray1=[c1,c3]
                newArray2=[c2,c4]
            if message_length==32:
                a,b,c1,c2,c3,c4,c5,c6=unpack_from('!HHiiiiii',rest_of_msg,0)
                newArray1=[c1,c3,c5]
                newArray2=[c2,c4,c6]
            if message_length==40:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8=unpack_from('!HHiiiiiiii',rest_of_msg,0)
                newArray1=[c1,c3,c5,c7]
                newArray2=[c2,c4,c6,c8]
            if message_length==48:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10=unpack_from('!HHiiiiiiiiii',rest_of_msg,0)
                newArray1=[c1,c3,c5,c7,c9]
                newArray2=[c2,c4,c6,c8,c10]
            if message_length==56:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12=unpack_from('!HHiiiiiiiiiiii',rest_of_msg,0)
                newArray1=[c1,c3,c5,c7,c9,c11]
                newArray2=[c2,c4,c6,c8,c10,c12]
            if message_length==64:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14=unpack_from('!HHiiiiiiiiiiiiii',rest_of_msg,0)
                newArray1=[c1,c3,c5,c7,c9,c11,c13]
                newArray2=[c2,c4,c6,c8,c10,c12,c14]
            if message_length==72:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16=unpack_from('!HHiiiiiiiiiiiiiiii',rest_of_msg,0)
                newArray1=[c1,c3,c5,c7,c9,c11,c13,c15]
                newArray2=[c2,c4,c6,c8,c10,c12,c14,c16]
            if message_length==80:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16,c17,c18=unpack_from('!HHiiiiiiiiiiiiiiiiii',rest_of_msg,0)
                newArray1=[c1,c3,c5,c7,c9,c11,c13,c15,c17]
                newArray2=[c2,c4,c6,c8,c10,c12,c14,c16,c18]
            if message_length==88:
                a,b,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16,c17,c18,c19,c20=unpack_from('!HHiiiiiiiiiiiiiiiiiiii',rest_of_msg,0)
                newArray1=[c1,c3,c5,c7,c9,c11,c13,c15,c17,c19]
                newArray2=[c2,c4,c6,c8,c10,c12,c14,c16,c18,c20]
        msg_type = 1
        if a==1:
            sentence = 'Όλα έγιναν σωστά! ;)'
            apotelesma=0
            k=0
            l=0
            if b<2 or b>10:
                l=l+1
            for i in newArray:
                if i>100 or i<-100:
                    k=k+1
            if k==0 and l==0:
                for i in newArray:
                    apotelesma = apotelesma + i
            else:
                if k!=0 and l==0:
                    sentence = 'Σφάλμα οι αριθμοί που θα δώσετε πρέπει να έχουν τιμή από -100 έως 100'
                elif l!=0 and k==0:
                    sentence = 'Σφάλμα οι αριθμοί που θα δώσετε πρέπει να είναι από 2 έως 10'
            nb = bytes(sentence,'utf-8')
            length=2*4+len(nb)
            padSize=(4 - len(nb) % 4) % 4
            message = ctypes.create_string_buffer(length+padSize)
            pack_into('!H',message,0,msg_type)
            pack_into('!H', message, 2, length)
            pack_into('!i',message,4,apotelesma)
            pack_into('x', message, 8)
            pack_into(str(len(nb))+'s', message, 8, nb)
            if(padSize>0):
                pack_into(str(padSize)+'x', message, 8+len(nb))
            conn.sendall(message)     
        elif a == 2:
            sentence = 'Όλα έγιναν σωστά! ;)'
            sum=0
            k=0
            l=0
            apotelesma = 0
            j = 0
            if b<2 or b>20:
                l=l+1
            for i in newArray:
                if i>200 or i<0:
                    k=k+1
            if k==0 and l==0:
                for i in newArray:
                    sum = sum + i
                    j=j+1
                apotelesma = sum/j
            else:
                if k!=0 and l==0:
                    sentence = 'Σφάλμα οι αριθμοί που θα δώσετε πρέπει να έχουν τιμή από 0 έως 200'
                elif l!=0 and k==0:
                    sentence = 'Σφάλμα οι αριθμοί που θα δώσετε πρέπει να είναι από 2 έως 20'
            nb = bytes(sentence,'utf-8')
            length=2*4+len(nb)
            padSize=(4 - len(nb) % 4) % 4
            message = ctypes.create_string_buffer(length+padSize)
            pack_into('!H',message,0,msg_type)
            pack_into('!H', message, 2, length)
            pack_into('!f',message,4,apotelesma)
            pack_into('x', message, 8)
            pack_into(str(len(nb))+'s', message, 8, nb)
            if(padSize>0):
                pack_into(str(padSize)+'x', message, 8+len(nb))
            conn.sendall(message)
        else:
            sentence = 'Όλα έγιναν σωστά! ;)'
            k=0
            n=0
            l=0
            apotelesma=0
            if b<2 or b>10:
                l=l+1
            for i in newArray1:
                if i>60000 or i<0:
                    k=k+1
            for i in newArray2:
                if i>60000 or i<0:
                    n=n+1
            if k==0 and l==0 and n==0:
                msg_type=4
                nb = bytes(sentence,'utf-8')
                length=4+len(nb)+4*b
                padSize=(4 - len(nb) % 4) % 4
                message = ctypes.create_string_buffer(length+padSize)
                pack_into('!H',message,0,msg_type)
                pack_into('!H', message, 2, length)
                offset=4
                for i in range(0,b):
                    sum=newArray1[i]+newArray2[i]
                    pack_into('!I',message,offset,sum)
                    offset=offset+4
                pack_into(str(len(nb))+'s', message, offset, nb)
                if(padSize>0):
                    pack_into(str(padSize)+'x', message, offset+len(nb))
                conn.sendall(message)
            if k!=0 or l!=0 or n!=0:
                msg_type=5
                if (k!=0 or n!=0) and l==0:
                    sentence = 'Σφάλμα οι αριθμοί που θα δώσετε πρέπει να έχουν τιμή από 0 έως 60000 και στα δύο σετ'
                elif l!=0 and k==0 and n==0:
                    sentence = 'Σφάλμα οι αριθμοί που θα δώσετε πρέπει να είναι από 2 έως 10 και στα δύο σετ'
                nb = bytes(sentence,'utf-8')
                length=4+len(nb)
                padSize=(4 - len(nb) % 4) % 4
                message = ctypes.create_string_buffer(length+padSize)
                pack_into('!H',message,0,msg_type)
                pack_into('!H', message, 2, length)
                pack_into(str(len(nb))+'s', message, 4, nb)
                if(padSize>0):
                    pack_into(str(padSize)+'x', message, 4+len(nb))
                conn.sendall(message)
        close=True
        conn.close()
        serverSocket.close()