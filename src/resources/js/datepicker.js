import dayjs from "dayjs";
import Litepicker from "litepicker";
import thLocale from 'dayjs/locale/th';
import buddhistEra from "dayjs/plugin/buddhistEra";

dayjs.locale(thLocale);
dayjs.extend(buddhistEra);

const format = {
    parse(date) {
        if (date instanceof Date) {
            return date;
        }
        if (typeof date === 'string') {
            return new Date(date);
        }
        if (typeof date === 'number') {
            return new Date(date);
        }

        return new Date();
    },
    output(date) {
        return date.toLocaleDateString('th-TH', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    }
}
window.config_datepicker = {
    single: {
        autoApply: false,
        singleMode: false,
        numberOfColumns: 2,
        numberOfMonths: 2,
        showWeekNumbers: true,
        format: "DD MMMM YYYY",
        dropdowns: {
            months: true,
            years: true,
            era: {
                format: 'B.E.',
                classes: 'buddhist-era',
            },
        },
        lang: 'th',
        buttonText: { "apply": "นำมาใช้", "cancel": "ยกเลิก", },
        format: format,
        setup: (picker) => {

            // Populate year dropdown
            picker.on('render', () => {
                let select_years = $('.month-item-year');

                select_years.each((index, select_year) => {
                    let option = $(select_year).find('option');
                    option.each((index, opt) => {
                        let value = opt.value;
                        opt.text = parseInt(value) + 543;
                    });
                });
            });
        },
    },
    range: {
        autoApply: false,
        singleMode: false,
        numberOfColumns: 2,
        numberOfMonths: 2,
        showWeekNumbers: true,
        format: "DD MMMM YYYY",
        dropdowns: {
            months: true,
            years: true,
            era: {
                format: 'B.E.',
                classes: 'buddhist-era',
            },
        },
        lang: 'th',
        buttonText: { "apply": "นำมาใช้", "cancel": "ยกเลิก", },
        format: format,
        setup: (picker) => {
            // Populate year dropdown
            picker.on('render', () => {
                let select_years = $('.month-item-year');

                select_years.each((index, select_year) => {
                    let option = $(select_year).find('option');
                    option.each((index, opt) => {
                        let value = opt.value;
                        opt.text = parseInt(value) + 543;
                    });
                });
            });
        },
    },
};


(function () {
    "use strict";
    // Litepicker

    $(".datepicker").each(function () {

        let options = window.config_datepicker.range;

        if ($(this).data("single-mode")) {
            options.singleMode = true;
            options.numberOfColumns = 1;
            options.numberOfMonths = 1;
        }

        if ($(this).data("format")) {
            options.format = $(this).data("format");
        }

        if (!$(this).val()) {
            let date = dayjs();
            date += !options.singleMode
                ? " - " + dayjs().add(1, "month")
                : "";
            $(this).val(date);
        }

        new Litepicker({
            element: this,
            ...options,
        });
    });
})();
