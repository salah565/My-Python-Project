class Student:
    def __init__(self, name, age, grade):
        self.name = name
        self.age = age
        self.grade = grade

    def show_info(self):
        print("Name:", self.name)
        print("Age:", self.age)
        print("Grade:", self.grade)

    def is_passed(self):
        if self.grade >= 10:
            print("Passed")
        else:
            print("Failed")


s1 = Student("Ahmed", 18, 14)
s2 = Student("Sara", 17, 8)

s1.show_info()
s1.is_passed()

print("----")

s2.show_info()
s2.is_passed()
