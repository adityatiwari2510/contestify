/*
* This should give CORRECT on the default problem 'hello',
 * since the random extra file will not be passed to javac.
 *
 * @EXPECTED_RESULTS@: CORRECT
 */

import java.io.*;

class Main {
  public static void main(String[] args) throws Exception {
    System.out.print("Hello world!\n");
  }
}
