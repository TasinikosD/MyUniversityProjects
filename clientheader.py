from struct import *
import socket 
import ctypes
serverIP = '127.0.0.1'
serverPort = 12345
close = False
clientSocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
clientSocket.connect((serverIP, serverPort))
print("Επιλέξτε ένα από τα: \n1.Πρόσθεση\n2.Μέσος Όρος\n3.Πρόσθεση σετ")
a=int(input('Επιλογή(1 ή 2 ή 3): '))
while a != 1 and a != 2 and a != 3:
    if a != 1 and a != 2 and a != 3:
        print("Παρακαλώ δώστε μία εκ των επιλογών 1 ή 2 ή 3 !!!")
        print("Επιλέξτε ένα από τα: \n1.Πρόσθεση\n2.Μέσος Όρος\n3.Πρόσθεση σετ")
        a=int(input('Επιλογή(1 ή 2 ή 3): '))
#  0               16                31
#  +----------------+-----------------+
#  |      Type      |      Length     |
#  +----------------+-----------------+
#  |        a       |        b        |
#  +----------------+-----------------+
#  |           Array......            |
#  +----------------+-----------------+
if a == 1:
    msg_type=0
    b=int(input("Δώστε μου πόσοι είναι οι αριθμοί που θέλετε να προσθέσετε ή να βγάλετε το μέσο όρο(από 2 έως 10): "))
    message_length=2*4+b*2
    message = ctypes.create_string_buffer(message_length)
    if b>10:
        message_length=2*4
        message = ctypes.create_string_buffer(message_length)
    pack_into('!H', message, 0, msg_type)
    pack_into('!H', message, 2, message_length)
    pack_into('!H', message, 4, a)
    pack_into('!H', message, 6, b)
    offset=8
    z=0
    if b>1 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=2 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=3 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=4 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=5 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=6 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2       
    if b>=7 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=8 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=9 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>9 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από -100 έως 100): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    clientSocket.sendall(message)
elif a==2:
    msg_type=0
    b=int(input("Δώστε μου πόσοι είναι οι αριθμοί που θέλετε να προσθέσετε ή να βγάλετε το μέσο όρο(από 2 έως 20): "))
    message_length=2*4+b*2
    message = ctypes.create_string_buffer(message_length)
    if b>10:
        message_length=2*4
        message = ctypes.create_string_buffer(message_length)
    pack_into('!H', message, 0, msg_type)
    pack_into('!H', message, 2, message_length)
    pack_into('!H', message, 4, a)
    pack_into('!H', message, 6, b)
    offset=8
    z=0
    if b>1 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=2 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=3 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=4 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=5 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=6 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2       
    if b>=7 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=8 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>=9 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    if b>9 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό")
        c1=int(input("Αριθμός(από 0 έως 200): "))
        pack_into('!h', message, offset, c1)
        offset=offset+2
    clientSocket.sendall(message)
else:
    msg_type=1
    b=int(input("Δώστε μου πόσοι είναι οι αριθμοί σε κάθε σετ που θέλετε να υπολογίσουμε το άθροισμά τους(από 2 έως 10 σε κάθε σετ): "))
    message_length=2*4+b*8
    message = ctypes.create_string_buffer(message_length)
    if b>10:
        message_length=2*4
        message = ctypes.create_string_buffer(message_length)
    pack_into('!H', message, 0, msg_type)
    pack_into('!H', message, 2, message_length)
    pack_into('!H', message, 4, a)
    pack_into('!H', message, 6, b)
    offset=8
    z=0
    if b>1 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    if b>=2 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    if b>=3 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    if b>=4 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    if b>=5 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    if b>=6 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4 
    if b>=7 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    if b>=8 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    if b>=9 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    if b>9 and b<=10:
        z=z+1
        print("Δώστε τον",z,"ο αριθμό του 1ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
        print("Δώστε τον",z,"ο αριθμό του 2ου σετ")
        c1=int(input("Αριθμός(από 0 έως 60000): "))
        pack_into('!i', message, offset, c1)
        offset=offset+4
    clientSocket.sendall(message)
#  0               16                31
#  +----------------+-----------------+
#  |      Type      |     Length      |
#  +----------------+-----------------+
#  |           Apotelesma             |
#  +----------------+-----------------+
#  |     Sentence   |     Padding1    |
#  +----------------+-----------------+
while not close:
    modifiedMessage=clientSocket.recv(4)
    type,length = unpack_from('!HH', modifiedMessage, 0)
    print('Total message length without pad=',int(length))
    padSize=(4 - length % 4) % 4
    print('Total message length with pad=',int(length+padSize))
    rest_of_msg = clientSocket.recv(length+padSize-4)
    if a==1:
        apotelesma, sentence = unpack_from('!i'+str(length-2*4)+'s', rest_of_msg, 0)
        print('Το άθροισμα είναι: ',apotelesma)
        print(sentence.decode('utf-8'))
    elif a==2:
        apotelesma, sentence = unpack_from('!f'+str(length-2*4)+'s', rest_of_msg, 0)
        print('Ο μέσος όρος είναι: ',apotelesma)
        print(sentence.decode('utf-8'))
    else:
        if type==4:
            if b==1:
                c1, sentence = unpack_from('!I'+str(length-4)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1)
                print(sentence.decode('utf-8'))
            if b==2:
                c1,c2, sentence = unpack_from('!II'+str(length-10)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2)
                print(sentence.decode('utf-8'))
            if b==3:
                c1,c2,c3, sentence = unpack_from('!III'+str(length-14)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2,c3)
                print(sentence.decode('utf-8'))
            if b==4:
                c1,c2,c3,c4, sentence = unpack_from('!IIII'+str(length-18)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2,c3,c4)
                print(sentence.decode('utf-8'))
            if b==5:
                c1,c2,c3,c4,c5, sentence = unpack_from('!IIIII'+str(length-22)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2,c3,c4,c5)
                print(sentence.decode('utf-8'))
            if b==6:
                c1,c2,c3,c4,c5,c6, sentence = unpack_from('!IIIIII'+str(length-26)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2,c3,c4,c5,c6)
                print(sentence.decode('utf-8'))
            if b==7:
                c1,c2,c3,c4,c5,c6,c7, sentence = unpack_from('!IIIIIII'+str(length-30)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2,c3,c4,c5,c6,c7)
                print(sentence.decode('utf-8'))
            if b==8:
                c1,c2,c3,c4,c5,c6,c7,c8, sentence = unpack_from('!IIIIIIII'+str(length-34)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2,c3,c4,c5,c6,c7,c8)
                print(sentence.decode('utf-8'))
            if b==9:
                c1,c2,c3,c4,c5,c6,c7,c8,c9, sentence = unpack_from('!IIIIIIIII'+str(length-38)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2,c3,c4,c5,c6,c7,c8,c9)
                print(sentence.decode('utf-8'))
            if b==10:
                c1,c2,c3,c4,c5,c6,c7,c8,c9,c10, sentence = unpack_from('!IIIIIIIIII'+str(length-42)+'s', rest_of_msg, 0)
                print("Το άθροισμα των σετ πινάκων είναι: ",c1,c2,c3,c4,c5,c6,c7,c8,c9,c10)
                print(sentence.decode('utf-8'))
        else:
            sentence=unpack_from(str(length-4)+'s',rest_of_msg,0)[0]
            print(sentence.decode('utf-8'))
    close=True
