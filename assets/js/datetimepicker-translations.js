$(document).ready( function() {
	$.datepicker.regional[language] = {
		closeText: texts.close,
		prevText: texts.prev,
		nextText: texts.next,
		currentText: texts.current,
		monthNames: [texts.january,texts.february,texts.march,texts.april,texts.may,texts.june,
		texts.july,texts.august,texts.september,texts.october,texts.november,texts.december],
		monthNamesShort: [texts.jan,texts.feb,texts.mar,texts.apr,texts.may,texts.jun,
		texts.jul,texts.aug,texts.sep,texts.oct,texts.nov,texts.dec],
		dayNames: [texts.monday,texts.tuesday,texts.wednesday,texts.thursday,texts.friday,texts.saturday,texts.sunday],
		dayNamesShort: [texts.mon,texts.tue,texts.wed,texts.thu,texts.fri,texts.sat,texts.sun],
		dayNamesMin: [texts.mo,texts.tu,texts.we,texts.th,texts.fr,texts.sa,texts.su],
	};
	$.datepicker.setDefaults($.datepicker.regional[language]);
	
	
	$.timepicker.regional[language] = {
		timeOnlyTitle: texts.chooseATime,
		timeText: texts.time,
		hourText: texts.hour,
		minuteText: texts.minute,
		secondText: texts.second,
		millisecText: texts.millisecond,
		timezoneText: texts.timezone,
		currentText: texts.current,
		closeText: texts.close,
	};
	$.timepicker.setDefaults($.timepicker.regional[language]);
});