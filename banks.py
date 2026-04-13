bank = 1000
while True:
    print("1. Show balance")
    print("2. Deposit")
    print("3. Withdraw")
    print("4. Exit")
    choice = input("Choose: ")
    if choice == "1":
        print("Balance:", bank)
    elif choice == "2":
        amount = float(input("Amount: "))
        bank += amount
    elif choice == "3":
        amount = float(input("Amount: "))
        if amount <= bank:
            bank -= amount
        else:
            print("Insufficient balance")
    elif choice == "4":
        break
    else:        print("Invalid choice")
     