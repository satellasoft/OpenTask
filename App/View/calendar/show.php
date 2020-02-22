<div class="card border-info">
  <div class="card-header">
    Calendário
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=BASE?>">Home</a></li>
          <li class="breadcrumb-item active">Calendário</li>
        </ol>
      </div>
    </div>
    <input type="hidden" id="strIds" class="form-control" value="<?=$strIds;?>">
    <div id='calendar-container' style="min-height:80vh;">
      <div id='calendar'></div>
    </div>
  </div>
</div>

<link href='../vendor/full-calendar/packages/core/main.css' rel='stylesheet' />
<link href='../vendor/full-calendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='../vendor/full-calendar/packages/timegrid/main.css' rel='stylesheet' />
<link href='../vendor/full-calendar/packages/list/main.css' rel='stylesheet' />
<script src='../vendor/full-calendar/packages/core/main.js'></script>
<script src='../vendor/full-calendar/packages/interaction/main.js'></script>
<script src='../vendor/full-calendar/packages/daygrid/main.js'></script>
<script src='../vendor/full-calendar/packages/timegrid/main.js'></script>
<script src='../vendor/full-calendar/packages/list/main.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  getTasks();
});

function getTasks(){
  var obj = {
    strIds : valueById('strIds'),
  }
  var base = valueById('base');

  console.log( base + "api/calendar/" + obj.strIds);

  $.ajax({
    url : base + "api/calendar/" + obj.strIds,
    type : 'GET',
    dataType : "JSON",
    success : function(data){
      if(data != null){
        createCalendar(data);
      }
    },
    error : function(error){
      console.log(error);
    }
  });

  function createCalendar(data){
    console.log(data);

    var events = [];

    for(var i = 0; i < data.length; i++){
      events.push({
        'title' : data[i].taskTitle,
        'start' : data[i].taskCreated,
        'end'   : data[i].taskDeadline
      });
    }

    var calendarEl = document.getElementById('calendar');
    var listEvents = [
      {
        title: 'Conference',
        start: '2019-11-08',
        end: '2019-11-13'
      }
    ];

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ['dayGrid', 'timeGrid', 'list' ],
      locale : 'pt-br',
      height: 'parent',
      header: {
        left: '',
        center: 'title',
        right: ''
      },
      defaultView: 'dayGridMonth',
      defaultDate: getCurrentDate(),
      navLinks: false, // can click day/week names to navigate views
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: events,
      eventColor: '#b2dded',
      eventBackgroundColor : '#b2dded'
    });

    calendar.render();

  }
}
</script>
