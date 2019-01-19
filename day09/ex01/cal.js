function plus() {
    var num1, num2, res;
    
    num1 = document.getElementById("n1").value;
    num1 = parseInt(num1);
    
    num2 = document.getElementById("n2").value;
    num2 = parseInt(num2);
    res = (num1 + num2);
    
    document.getElementById("out").innerHTML = res;
}

function minus() {
    var num1, num2, res;
    
    num1 = document.getElementById("n1").value;
    num1 = parseInt(num1);
    
    num2 = document.getElementById("n2").value;
    num2 = parseInt(num2);
    res = (num1 - num2);
    
    document.getElementById("out").innerHTML = res;
}

function res() {
    var num1, num2, op;
    
    num1 = document.getElementById("n1").value;
    num1 = parseInt(num1);
    
    num2 = document.getElementById("n2").value;
    num2 = parseInt(num2);
    op = document.getElementById('operand').value;
    
    if (op === '+')
        document.getElementById("out").innerHTML = num1 + num2;
    if (op === '-')
        document.getElementById("out").innerHTML = num1 - num2;
    if (op === '*')
        document.getElementById("out").innerHTML = num1 * num2;
    if (op === '/')
        document.getElementById("out").innerHTML = num1 / num2;
    if (op === '%')
        document.getElementById("out").innerHTML = num1 % num2;
}