function aesEncrypt(text, password, init) {
    var key = aesjs.util.convertStringToBytes(md5(password));
    var iv  = aesjs.util.convertStringToBytes(init);

    // Convert text to bytes
    var textBytes      = aesjs.util.convertStringToBytes(text);

    var aesOfb         = new aesjs.ModeOfOperation.ofb(key, iv);
    var encryptedBytes = aesOfb.encrypt(textBytes);

    return encryptedBytes;
}

function aesDecrypt(encryptedBytes, password, init) {
    var key = aesjs.util.convertStringToBytes(md5(password));
    var iv  = aesjs.util.convertStringToBytes(init);

    // The output feedback mode of operation maintains internal state,
    // so to decrypt a new instance must be instantiated.
    var aesOfb         = new aesjs.ModeOfOperation.ofb(key, iv);
    var decryptedBytes = aesOfb.decrypt(encryptedBytes);

    var decryptedText  = aesjs.util.convertBytesToString(decryptedBytes);

    return decryptedText;
}
