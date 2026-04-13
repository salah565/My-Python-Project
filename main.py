low = 1
high = 100

print("Think of a number between 1 and 100.")
print("Answer only with: yes or no")

while low < high:
    mid = (low + high) // 2

    answer = input(f"Is your number greater than {mid}? ").strip().lower()

    if answer == "yes":
        low = mid + 1
    elif answer == "no":
        high = mid
    else:
        print("Please answer with yes or no.")

print("Your number is:", low)