--TEST--
test streamable non LOB types.
--SKIPIF--
<?php require('skipif.inc'); ?>
--FILE--
<?php

    sqlsrv_configure('WarningsReturnAsErrors', 0);
    sqlsrv_configure('LogSeverity', SQLSRV_LOG_SEVERITY_ALL);

    require_once("MsCommon.inc");

    $conn = connect();
    if (!$conn) {
        fatalError("Failed to connect.");
    }
    // test the allowed non LOB column types
    $stmt = sqlsrv_query($conn, "SELECT [char_short_type], [varchar_short_type], [nchar_short_type], [nvarchar_short_type], [binary_short_type], [varbinary_short_type] FROM [test_streamable_types]");
    sqlsrv_fetch($stmt);
    $stream = sqlsrv_get_field($stmt, 0, SQLSRV_PHPTYPE_STREAM("char"));
    $char_field = fread($stream, 4096);
    echo "$char_field\n";
    $stream = sqlsrv_get_field($stmt, 1, SQLSRV_PHPTYPE_STREAM("char"));
    $varchar_field = fread($stream, 4096);
    echo "$varchar_field\n";
    $stream = sqlsrv_get_field($stmt, 2, SQLSRV_PHPTYPE_STREAM("binary"));
    $nchar_field = fread($stream, 4096);
    echo "$nchar_field\n";
    $stream = sqlsrv_get_field($stmt, 3, SQLSRV_PHPTYPE_STREAM("binary"));
    $nvarchar_field = fread($stream, 4096);
    echo "$nvarchar_field\n";
    $stream = sqlsrv_get_field($stmt, 4, SQLSRV_PHPTYPE_STREAM("binary"));
    $binary_field = fread($stream, 4096);
    echo "$binary_field\n";
    $stream = sqlsrv_get_field($stmt, 5, SQLSRV_PHPTYPE_STREAM("binary"));
    $varbinary_field = fread($stream, 4096);
    echo "$varbinary_field\n";

    // test not streamable types
    $stmt = sqlsrv_query($conn, "SELECT * FROM [test_types]");
    sqlsrv_fetch($stmt);
    $stream = sqlsrv_get_field($stmt, 0, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 1, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 2, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 3, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 4, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 5, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 6, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 7, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 8, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 9, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 10, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }
    $stream = sqlsrv_get_field($stmt, 11, SQLSRV_PHPTYPE_STREAM("char"));
    if ($stream === false) {
        print_r(sqlsrv_errors());
    }

?>
--EXPECT--
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA                                                        
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A                                                                                                                 
A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A A 
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA                                                        
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -6
            [code] => -6
            [2] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
            [message] => Only char, nchar, varchar, nvarchar, binary, varbinary, and large object types can be read by using streams.
        )

)
