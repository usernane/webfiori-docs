<?php
/*
 * The MIT License
 *
 * Copyright (c) 2020 Ibrahim BinAlshikh, WebFiori Collections.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace webfiori\collections;

/**
 * An interface that is used to compare objects. It is used by the class 
 * LinkedList's sorting method in order to compare objects.
 * 
 * @author Ibrahim
 * 
 * @version 1.0
 */
interface Comparable {
    /**
     * Compare the given instance with another object.
     * 
     * The implementation of this method should be as follows. 
     * If the two objects are equal, the method should return 0. 
     * If the current instance is greater, the method should return positive number. 
     * If the object at the parameter is greater, the method should return a negative number.
     * 
     * @param mixed $other The other variable that will be compared 
     * with.
     * 
     * @return int Negative value, 0 or positive value.
     * 
     * @since 1.0
     */
    public function compare($other);
}
