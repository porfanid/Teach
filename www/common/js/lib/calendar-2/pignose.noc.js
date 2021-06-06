$(function() {

$('.calendar').pignoseCalendar({
    scheduleOptions: {
        colors: {
            offer: '#2fabb7',
            ad: '#5c6270'
        }
    },
    schedules: [{
        name: 'offer',
        date: '2017-02-08'
    }, {
        name: 'ad',
        date: '2017-02-08'
    }, {
        name: 'offer',
        date: '2017-02-05',
    }],

select: function(date, context) {
        console.log('events for this date', context.storage.schedules);
    }

  });

});

