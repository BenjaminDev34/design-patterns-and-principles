# Lizkov Substitution

The Lizkov Substitution stands for L in SOLID design.

## Definition

In simple terms, Lizkov substitution means that subtypes must be substitutable for their base types without causing errors in our program... In other words, you should never extend a class in such a way as to invalidate any functionality of that class, otherwise they're not substitutable and that's a problem.

## What is a subtype ?

A subtype is a class that extends another class or a class that implements an interface. 

## Bad practice :no_entry: