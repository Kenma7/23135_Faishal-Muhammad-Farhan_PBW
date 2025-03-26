const kalkulator = (operator, ...numbers) => {
    console.log(`Memulai operasi ${operator} dengan angka: ${numbers.join(', ')}`);
    let result;
    switch (operator) {
        case '+':
            result = numbers.reduce((acc, num) => acc + num, 0);
            break;
        case '-':
            result = numbers.reduce((acc, num) => acc - num);
            break;
        case '*':
            result = numbers.reduce((acc, num) => acc * num, 1);
            break;
        case '/':
            result = numbers.reduce((acc, num) => acc / num);
            break;
        case '%':
            result = numbers.reduce((acc, num) => acc % num);
            break;
        default:
            return 'Operator tidak valid';
    }
    console.log(`Hasil dari operasi ${operator} adalah: ${result}`);
    return result;
};

// Contoh penggunaan
console.log(kalkulator('+', 10, 20, 30)); // Output: 60
console.log(kalkulator('-', 50, 20, 10)); // Output: 20
console.log(kalkulator('*', 2, 3, 4));    // Output: 24
console.log(kalkulator('/', 100, 5, 2));  // Output: 10
console.log(kalkulator('%', 100, 30));    // Output: 10
