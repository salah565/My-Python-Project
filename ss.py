

def get_note(message):
    while True:
        try:
            note = float(input(message))
            if 0 <= note <= 20:
                return note
            else:
                print("Error")
        except ValueError:
            print("Error: enter a valid number")


def get_coefficient(message):
    while True:
        try:
            c = float(input(message))
            if c > 0:
                return c
            else:
                print("Error: coefficient must be greater than 0")
        except ValueError:
            print("Error: enter a valid number")


def math_average():
    n1 = get_note("Math note 1: ")
    n2 = get_note("Math note 2: ")
    n3 = get_note("Math note 3: ")
    c = get_coefficient("Math coefficient: ")

    avg = (n1 + n2 + n3) / 3
    return avg, c


def physics_average():
    n1 = get_note("Physics note 1: ")
    n2 = get_note("Physics note 2: ")
    n3 = get_note("Physics note 3: ")
    exam = get_note("Physics exam: ")
    c = get_coefficient("Physics coefficient: ")

    avg = ((n1 + n2 + n3) / 3) * 0.75 + exam * 0.25
    return avg, c


def science_average():
    n1 = get_note("Science note 1: ")
    n2 = get_note("Science note 2: ")
    exam = get_note("Science exam: ")
    c = get_coefficient("Science coefficient: ")

    avg = ((n1 + n2) / 2) * 0.75 + exam * 0.25
    return avg, c


math_avg, math_c = math_average()
physics_avg, physics_c = physics_average()
science_avg, science_c = science_average()

total = (math_avg * math_c) + (physics_avg * physics_c) + (science_avg * science_c)
coeff_total = math_c + physics_c + science_c

general = total / coeff_total

print(f"General average: {general:.2f}")

if general >= 10:
    print("Valid")
else:
    print("Invalid")


