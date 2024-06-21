// Formatea EL PHONE NUMBER

    function formatPhoneNumber(value) {
        if (!value) return value;
        const phoneNumber = value.replace(/[^\d]/g, '');
        const phoneNumberLength = phoneNumber.length;
        if (phoneNumberLength < 4) return phoneNumber;
        if (phoneNumberLength < 7) {
            // return `(${phoneNumber.slice(0, 3)}) ${phoneNumber.slice(3)}`;    ORIGINAL
            return `${phoneNumber.slice(0, 3)}-${phoneNumber.slice(3)}`;      //NEW
        }
        // return `(${phoneNumber.slice(0, 3)}) ${phoneNumber.slice(      ORIGINAL
        //                 3,
        //                 6
        //               )}-${phoneNumber.slice(6, 9)}`;

            return `${phoneNumber.slice(0, 3)}-${phoneNumber.slice(
                        3,
                        6
                        )}-${phoneNumber.slice(6, 9)}`;                      
    }

    function phoneNumberFormatter() {
        const inputField = document.getElementById('phone-number');
        const formattedInputValue = formatPhoneNumber(inputField.value);
        inputField.value = formattedInputValue;
    }

    function phoneNumberFormatter2() {
        const inputField = document.getElementById('phone-number2');
        const formattedInputValue = formatPhoneNumber(inputField.value);
        inputField.value = formattedInputValue;
    }
