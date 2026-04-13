balance = 1000

def show_balance():
    print("Balance:", balance)

def deposit():
    global balance
    amount = float(input("Amount: "))

    if amount <= 0:
        print("Invalid amount")
    else:
        balance += amount
        print("Deposit successful")

def withdraw():
    global balance
    amount = float(input("Amount: "))

    if amount <= 0:
        print("Invalid amount")
    elif amount <= balance:
        balance -= amount
        print("Withdraw successful")
    else:
        print("Insufficient balance")

def menu():
    print("\n1. Show balance")
    print("2. Deposit")
    print("3. Withdraw")
    print("4. Exit")

while True:
    menu()
    choice = input("Choose: ")

    if choice == "1":
        show_balance()

    elif choice == "2":
        deposit()

    elif choice == "3":
        withdraw()

    elif choice == "4":
        print("Goodbye")
        break

    else:
        print("Invalid choice")






