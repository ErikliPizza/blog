<style>



.btn-action{
  cursor: pointer;
  padding-top: 10px;
  width: 30px;
}

.btn-ctn, .infos-ctn{
  display: flex;
  align-items: center;
  justify-content: center;
}
.infos-ctn{
padding-top: 20px;
}

.btn-ctn > div {
 padding: 5px;
 margin-top: 18px;
 margin-bottom: 18px;
}

.infos-ctn > div {
 margin-bottom: 8px;
 color: #ffc266;
}

.first-btn{
  margin-left: 3px;
}

.duration{
  margin-left: 10px;
}



.player-ctn{
  border-radius: 15px;
  width: 420px;
  padding: 10px;
  background-color: #373737;
  margin:auto;
  margin-top: 100px;
}

.playlist-track-ctn{
  display: flex;
  background-color: #464646;
  margin-top: 3px;
  border-radius: 5px;
  cursor: pointer;
}
.playlist-track-ctn:last-child{
  /*border: 1px solid #ffc266; */
}

.playlist-track-ctn > div{
  margin:10px;
}
.playlist-info-track{
  width: 80%;
}
.playlist-info-track,.playlist-duration{
  padding-top: 7px;
  padding-bottom: 7px;
  color: #e9cc95;
  font-size: 14px;
  pointer-events: none;
}
.playlist-ctn{
   padding-bottom: 20px;
}
.active-track{
  background: #4d4d4d;
  color: #ffc266 !important;
  font-weight: bold;
  
}

.active-track > .playlist-info-track,.active-track >.playlist-duration,.active-track > .playlist-btn-play{
  color: #ffc266 !important;
}


.playlist-btn-play{
  pointer-events: none;
  padding-top: 5px;
  padding-bottom: 5px;
}


</style>

<audio id="myAudio">
  <!-- <source src="audio.ogg" type="audio/ogg"> -->
  <source id="source-audio" src="" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

<div class="col-md-4">
    <div class="mb-4 box-shadow">
                                  <img class="card-img-top" src="{{ asset('storage/other/flowers.png') }}" style="height: 225px; width: 100%; display: block;">
        <div class="btn-ctn">
            <div class="btn-action" onclick="toggleAudio()">
                <div id="btn-faws-play-pause">
                    <i class='fas fa-play' id="icon-play"></i>
                    <i class='fas fa-pause' id="icon-pause" style="display: none"></i>
                </div>
            </div>
    <div class="btn-mute" id="toggleMute" onclick="toggleMute()">
        <div id="btn-faws-volume">
            <i id="icon-vol-up" class='fas fa-volume-up'></i>
            <i id="icon-vol-mute" class='fas fa-volume-mute' style="display: none"></i>
        </div>
    </div>
  </div>
  <div class="playlist-ctn"></div>
  </div>
</div>

<script>
  function createTrackItem(index,name,duration){
    var trackItem = document.createElement('div');
    trackItem.setAttribute("class", "playlist-track-ctn");
    trackItem.setAttribute("id", "ptc-"+index);
    trackItem.setAttribute("data-index", index);
    document.querySelector(".playlist-ctn").appendChild(trackItem);

    var playBtnItem = document.createElement('div');
    playBtnItem.setAttribute("class", "playlist-btn-play");
    playBtnItem.setAttribute("id", "pbp-"+index);
    document.querySelector("#ptc-"+index).appendChild(playBtnItem);

    var btnImg = document.createElement('i');
    btnImg.setAttribute("class", "fas fa-play");
    btnImg.setAttribute("height", "40");
    btnImg.setAttribute("width", "40");
    btnImg.setAttribute("id", "p-img-"+index);
    document.querySelector("#pbp-"+index).appendChild(btnImg);

    var trackInfoItem = document.createElement('div');
    trackInfoItem.setAttribute("class", "playlist-info-track");
    trackInfoItem.innerHTML = name
    document.querySelector("#ptc-"+index).appendChild(trackInfoItem);

    var trackDurationItem = document.createElement('div');
    trackDurationItem.setAttribute("class", "playlist-duration");
    trackDurationItem.innerHTML = duration
    document.querySelector("#ptc-"+index).appendChild(trackDurationItem);
  }

  var listAudio = [
    {
      name:"A song for beautiful you from the dev :)",
      file:"https://home.noircontact.tech/storage/audio/featured.mp3",
      duration:"03:38"
    }
  ]

  for (var i = 0; i < listAudio.length; i++) {
      createTrackItem(i,listAudio[i].name,listAudio[i].duration);
  }
  var indexAudio = 0;

  function loadNewTrack(index){
    var player = document.querySelector('#source-audio')
    player.src = listAudio[index].file
    this.currentAudio = document.getElementById("myAudio");
    this.currentAudio.load()
    this.toggleAudio()
    this.updateStylePlaylist(this.indexAudio,index)
    this.indexAudio = index;
  }

  var playListItems = document.querySelectorAll(".playlist-track-ctn");

  for (let i = 0; i < playListItems.length; i++){
    playListItems[i].addEventListener("click", getClickedElement.bind(this));
  }

  function getClickedElement(event) {
    for (let i = 0; i < playListItems.length; i++){
      if(playListItems[i] == event.target){
        var clickedIndex = event.target.getAttribute("data-index")
        if (clickedIndex == this.indexAudio ) { // alert('Same audio');
            this.toggleAudio()
        }else{
            loadNewTrack(clickedIndex);
        }
      }
    }
  }

  document.querySelector('#source-audio').src = listAudio[indexAudio].file


  var currentAudio = document.getElementById("myAudio");

  currentAudio.load()
  


  var interval1;

  function toggleAudio() {

    if (this.currentAudio.paused) {
      document.querySelector('#icon-play').style.display = 'none';
      document.querySelector('#icon-pause').style.display = 'block';
      document.querySelector('#ptc-'+this.indexAudio).classList.add("active-track");
      this.playToPause(this.indexAudio)
      this.currentAudio.play();
    }else{
      document.querySelector('#icon-play').style.display = 'block';
      document.querySelector('#icon-pause').style.display = 'none';
      this.pauseToPlay(this.indexAudio)
      this.currentAudio.pause();
    }
  }

  function pauseAudio() {
    this.currentAudio.pause();
    clearInterval(interval1);
  }



  var width = 0;


  function playToPause(index){
    var ele = document.querySelector('#p-img-'+index)
    ele.classList.remove("fa-play");
    ele.classList.add("fa-pause");
  }

  function pauseToPlay(index){
    var ele = document.querySelector('#p-img-'+index)
    ele.classList.remove("fa-pause");
    ele.classList.add("fa-play");
  }


  function toggleMute(){
    var btnMute = document.querySelector('#toggleMute');
    var volUp = document.querySelector('#icon-vol-up');
    var volMute = document.querySelector('#icon-vol-mute');
    if (this.currentAudio.muted == false) {
       this.currentAudio.muted = true
       volUp.style.display = "none"
       volMute.style.display = "block"
    }else{
      this.currentAudio.muted = false
      volMute.style.display = "none"
      volUp.style.display = "block"
    }
  }
</script>