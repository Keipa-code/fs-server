"use strict";

function sequence (start = 0, step = 1){
    let a = 0;
    return function() {
        a++;
        if (a<=1){
            return start;
        }else {
            return start + step;
        }
    }
}

function take(x,z){
    let gen = x;
    for (let c=0; c<=z; c++){
        return gen;
    }
}

let generator = sequence(10,3);

console.log(take(generator(),5));