<a href="https://ciprian.pro"><img src="https://storage.googleapis.com/ciprianpro.appspot.com/images/dominoes/logo-black.png" alt="Ciprian.pro" title="Ciprian.pro" width="110" align="right"></a>

# Find square area - programming exercise

Given an array with strings of 0s and 1s, write a function that determines the area of the largest square that only contains 1s.

For example, the input may be ["00101", "11101", "11111", "11111", "01001"], which would represent the following matrix:

```sh
> 0 0 1 0 1
> 1 1 1 0 1
> 1 1 1 1 1
> 1 1 1 1 1
> 0 1 0 0 1
```

For this input the biggest square of 1s is 3x3, so your function should return 9.

## 2x2 square process

<p>&nbsp;</p>

<p align="center">
  <img alt="Find square info" src="https://raw.githubusercontent.com/ciprian-cimpan/find-square/master/img/find-square.gif">
</p>

<p>&nbsp;</p>

<p>We imagine a 2x2 square, which will be used to iterate through a helper array.</p>

<p>This helper array stores computed values which indicate what is the maximum square lenght that can be formed when a certain line is iterated.</p>

<p>As we iterate forward, we'll need the bottom-right corner to store the max square value. This value can be computed by taking the minimum value of its neighbours and adding itself to the sum.</p>

<p>If this value is bigger than what we have stored as the max square lenght, we update the value.</p>

<p>Before moving to the next interation, we copy the second helper array into the first one.<br />The second array ($store[1]) will then have its data overwritten by newer computations.</p>

<p>&nbsp;</p>

## Memory usage: array store vs generate

<p>CPU: Intel Core i3-8100B @ 3,6 GHz</p>

<p>
  <img alt="Find square info" src="https://raw.githubusercontent.com/ciprian-cimpan/find-square/master/img/bench-1.png" width="580">
</p>

<p>&nbsp;</p>

## Usage

* Clone repository 

* Open a new terminal window and run the following command:

```sh
$ /path/to/your/php index.php DATA_TYPE ROWS COLS
```

```sh
DATA_TYPE: array, generate, file
```

```sh
ROWS: number of array items
```

```sh
COLS: number of characters in each array
```

* Or open it in a browser (no options available):

```sh
$ /path/to/your/php -S localhost:8000
```


## FAQ

- **I have a question...**

Please contact me at hello@ciprian.pro for more details.

## Authors

* **Ciprian Cimpan** - [Ciprian.pro](https://ciprian.pro)
