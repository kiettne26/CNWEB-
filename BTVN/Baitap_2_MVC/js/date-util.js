var DateUtil = (function () {

    function CompareDatesDDMMYYYY(date1, date2, charSplit) {
        function parseDate(input) {
            let parts = input.split(charSplit);
            let year = parseInt(parts[2]);
            let month = parseInt(parts[1] - 1);
            let date = parseInt(parts[0]);
            return new Date(year, month, date);
        }

        const d1 = parseDate(date1);
        const d2 = parseDate(date2);

        if (d1 > d2) {
            return 1;
        } else if (d1 < d2) {
            return -1;
        } else {
            return 0;
        }
    }

    function ParseISOToDDMMYYYY(iValue, charSplit) {
        const [year, month, day] = iValue.split(charSplit);
        return `${day.split('T')[0]}${charSplit}${month}${charSplit}${year}`;
    }   

    function ParseDDMMYYYYToISO(iValue, charSplit) {
        if (iValue) {
            const dateParts = iValue.split(charSplit);
            const dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0], 0, 0, 0);
            dateObject.setHours(dateObject.getHours() + 7);
            const oValue = dateObject.toISOString().split('T')[0];
            return oValue;
        }
        return '';
    }    

    function FormatDateToDDMMYYYY(dateString, charSplit) {
        var date = new Date(dateString);
        var day = String(date.getDate()).padStart(2, '0');
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var year = date.getFullYear();
        return `${day}${charSplit}${month}${charSplit}${year}`;
    }

    function FormatDateNowToDDMMYYYY(charSplit) { 
        var date = new Date();
        var day = String(date.getDate()).padStart(2, '0');
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var year = date.getFullYear();
        return `${day}${charSplit}${month}${charSplit}${year}`;
    }

    return { CompareDatesDDMMYYYY, ParseISOToDDMMYYYY, ParseDDMMYYYYToISO, FormatDateToDDMMYYYY, FormatDateNowToDDMMYYYY };
})