/*!
 * oneui - v4.8.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2020
 */
!function(){
  function e(e,t){
    for(var n=0;n<t.length;n++){
      var a=t[n];
      a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)
    }
  }
  var t=function(){
        function t(){
          !function(e,t){
            if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")
          }(this,t)
        }var n,a;
        return n=t,a=[
          {
            key:"addEvent",
            value:function(){
              var e=jQuery(".js-add-event"),
              t="";
              jQuery(".js-form-add-event").on("submit",(function(n){
                return(t=e.prop("value"))&&(jQuery("#js-events").prepend('<li><div class="js-event p-2 text-white font-size-sm font-w500 bg-info">'+jQuery("<div />").text(t).html()+"</div></li>"),e.prop("value","")),!1
              }))
            }
          },
          {
            key:"changeCalendarID",
            value:function(value){
              document.getElementById("base-info").dataset.id_calendar = value
            }
          },
          {
            key:"initEvents",
            value:function(){
              new FullCalendar.Draggable(document.getElementById("js-events"),{
                  itemSelector:".js-event",
                  eventData:function(e){
                    return{
                      title:e.innerText,
                      backgroundColor:getComputedStyle(e).backgroundColor,
                      borderColor:getComputedStyle(e).backgroundColor
                    }
                  },
                  eventDrop:  function(info){
                  }
              })
            }
          },
          {
            key:"initCalendar",
            value:function(){
              var e=new Date,
              t=e.getDate(),
              n=e.getMonth(),
              a=e.getFullYear();
              var dataColor = []
              return {
                calendar: new FullCalendar.Calendar(document.getElementById("js-calendar"),
                {
                  eventSources: [
                      {
                          url: document.getElementById("base-info").dataset.base_url+'getData/'+ document.getElementById("base-info").dataset.id_calendar,
                          method: 'GET',
                          failure: function() {
                              alert('There was an error while fetching events!');
                          },
                          success: function(data) {
                            data.forEach((item, i) => {
                              dataColor.push(item.color)
                            });

                          }
                      }
                  ],
                  eventClick: function(info) {
                      eventId = info.event.id

                      $('#detail_event').data('eventId', eventId)
                      $('#detail_event').modal('show');
                      let nameday
                      let date
                      if(info.event.start.getDate().toString().length == 1) {
                        date = '0' + info.event.start.getDate()
                      } else {
                        date = info.event.start.getDate()
                      }


                      switch(info.event.start.getDay()) {
                        case 0:
                          nameday = "AHAD"
                          break;
                        case 1:
                          nameday = "SENIN"
                          break;
                        case 2:
                          nameday = "SELASA"
                          break;
                        case 3:
                          nameday = "RABU"
                          break;
                        case 4:
                          nameday = "KAMIS"
                          break;
                        case 5:
                          nameday = "JUM`AT"
                          break;
                        case 6:
                          nameday = "SABTU"
                          break;
                        default:
                          nameday = "SENIN"
                      }

                      if (info.event.end == null) {
                          endDate = parseInt(info.event.start.getDate()) + 1
                      } else {
                          endDate = parseInt(info.event.end.getDate())
                      }

                      $('.wadah-bulan').html(info.event.start.toLocaleString('default', { month: 'long' }))
                      $('.wadah-title').html(info.event.title)
                      $('.wadah-hari').html(nameday)
                      if ((endDate - 1)  != parseInt(info.event.start.getDate())) {
                          endDate = endDate - 1
                          if (endDate.toString().length == 1) {
                            endDate = '0'+endDate
                          }
                          el = `<span class="display-2">${date}</span> <div class="display-6">TO</div> <span class="display-2">${endDate}</span>`
                          $('.wadah-tanggal').html(el);
                      } else {
                          el = `<div class="display-2">${date}</div>`
                          $('.wadah-tanggal').html(el);
                      }

                      $('.wadah-description').html(info.event.extendedProps.description);

                      // reset color
                      for (var i = 1; i <=  6; i++) {
                          $('.card-tanggal').removeClass("color"+i)
                      }
                      $('.card-tanggal').removeClass("colorsalmon")

                      $('.card-tanggal').addClass("color"+info.event.backgroundColor)


                      info.jsEvent.preventDefault();
                  },
                  eventDrop: function(info) {

                      let eventId
                      if (info.event.id == "") {
                        eventId = $('#detail_event').data('eventId')
                      } else {
                        eventId = info.event.id
                      }
                      console.log(info.event.start.toISOString());
                      // Edit start and end date
                      let csrf_token = document.querySelector('#base-info').dataset.csrf_token
                      var data = {
                        'data': {
                          'summary': info.event.title,
                          'location': 'Politeknik Harapan Bersama',
                          'start' : {
                              'date' : info.event.start.toISOString().split('T')[0],
                              'timeZone' : 'Asia/Jakarta',
                          },
                          'end' : {
                              'date' : (info.event.end == null) ? info.event.start.toISOString().split('T')[0] : info.event.end.toISOString().split('T')[0],
                              'timeZone' : 'Asia/Jakarta',
                          },
                          'description': info.event.extendedProps.description,
                          'colorId': 6
                        },
                        'eventId': eventId,
                        'id_calendar': document.querySelector('#base-info').dataset.id_calendar,
                        [csrf_token]: document.querySelector('#base-info').dataset.csrf_value
                      }

                      let url = document.querySelector('#base-info').dataset.base_url + 'updateEvent/'
                      $.post(url, data, function(data, status){
                          id_calendar = JSON.parse(data).id_calendar
                          csrf_value = JSON.parse(data).csrf_new

                          document.querySelector('#base-info').dataset.id_calendar = id_calendar
                          document.querySelector('#base-info').dataset.csrf_value = csrf_value
                      });

                  },
                  eventResize: function(info) {
                    let eventId
                    if (info.event.id == "") {
                      eventId = $('#detail_event').data('eventId')
                    } else {
                      eventId = info.event.id
                    }


                    let endDate = new Date(info.event._instance.range.end.setDate(info.event._instance.range.end.getDate()))
                    let startDate = new Date(info.event._instance.range.start.setDate(info.event._instance.range.start.getDate()))


                    let csrf_token = document.querySelector('#base-info').dataset.csrf_token

                    var data = {
                      'data': {
                        'summary': info.event.title,
                        'location': 'Politeknik Harapan Bersama',
                        'start' : {
                            'date' : startDate.toISOString().split('T')[0],
                            'timeZone' : 'Asia/Jakarta',
                        },
                        'end' : {
                            'date' : endDate.toISOString().split('T')[0],
                            'timeZone' : 'Asia/Jakarta',
                        },
                        'description': info.event.extendedProps.description,
                        'colorId': 6
                      },
                      'eventId': eventId,
                      'id_calendar': document.querySelector('#base-info').dataset.id_calendar,
                      [csrf_token]: document.querySelector('#base-info').dataset.csrf_value
                    }

                    // Mengambil url
                    let url = document.querySelector('#base-info').dataset.base_url + 'updateEvent/'
                    $.post(url, data, function(data, status){
                        id_calendar = JSON.parse(data).id_calendar
                        csrf_value = JSON.parse(data).csrf_new

                        document.querySelector('#base-info').dataset.id_calendar = id_calendar
                        document.querySelector('#base-info').dataset.csrf_value = csrf_value
                    });
                  },
                  loading: function(loading) {
                      if (loading) {
                          $('#page-header-loader').removeClass('hide');
                          $('#page-header-loader').addClass('show');
                      } else {
                          $('#page-header-loader').removeClass('show');
                          $('#page-header-loader').addClass('hide');
                      }
                  },
                  themeSystem:"bootstrap",
                  firstDay:1,
                  editable:!0,
                  droppable:!0,
                  showNonCurrentDates: true,
                  headerToolbar:{
                    left:"title",
                    right:"prev,next today dayGridMonth,timeGridWeek,timeGridDay,listWeek"
                  },
                  drop:function(e){
                    // e.draggedEl.parentNode.remove()
                    // Simpan ke google calendar
                    // Menyiapkan data

                    let csrf_token = document.querySelector('#base-info').dataset.csrf_token

                    let endDate = e.date.setDate(e.date.getDate() + 1)

                    endDate = new Date(endDate).toISOString().split('T')[0]

                    console.log(e.date.toISOString().split('T')[0], endDate);

                    var data = {
                      'data': {
                        'summary': JSON.parse(e.draggedEl.dataset.event).title,
                        'location': 'Politeknik Harapan Bersama',
                        'start' : {
                            'date' : e.date.toISOString().split('T')[0],
                            'timeZone' : 'Asia/Jakarta',
                        },
                        'end' : {
                            'date' : endDate,
                            'timeZone' : 'Asia/Jakarta',
                        },
                        'description': JSON.parse(e.draggedEl.dataset.event).description,
                        'colorId': JSON.parse(e.draggedEl.dataset.event).color
                      },
                      'id_calendar': document.querySelector('#base-info').dataset.id_calendar,
                      [csrf_token]: document.querySelector('#base-info').dataset.csrf_value
                    }

                    // Mengambil url
                    let url = document.querySelector('#base-info').dataset.base_url + 'addEvent/'
                    $.post(url, data, function(data, status){
                        id_calendar = JSON.parse(data).id_calendar
                        csrf_value = JSON.parse(data).csrf_new
                        eventId = JSON.parse(data).eventId
                        $('#detail_event').data('eventId',eventId)

                        document.querySelector('#base-info').dataset.id_calendar = id_calendar
                        document.querySelector('#base-info').dataset.csrf_value = csrf_value
                    });
                  },
                }),
                dataColor: dataColor
              }

            }
          },
          {
            key:"init",
            value:function(){
              this.addEvent(),
              this.initEvents(),
              this.initCalendar().calendar.render()

              this.initCalendar().dataColor.forEach((item, i) => {
                  console.log(item)
                  $('.fc-event-main').eq(i).addClass('color'+item)
              });
            }
          }
        ],
        null&&e(n.prototype,null),a&&e(n,a),t
      }();

      jQuery((function(){
        t.init()

        $('#select-prodi').on('change', function(){
          t.changeCalendarID(this.value)
          t.initCalendar().calendar.render()
        })

        $('.trash-button').click(function() {
            let url = $('#base-info').data('base_url') +'deleteEvent/'+ eventId +'/'+ $('#base-info').data('id_calendar')
            $('#detail_event').modal('hide')
            $.get(url, function(data, status){
                t.initCalendar().calendar.render()
            });
        })



      }))
    }();

  // Problems
  // dataColor undefined in global scope
  // External event hasn't an id directly
