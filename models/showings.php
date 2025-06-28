<?php
require_once("Model.php");

class showings extends Model{

    private int $showingId; 
    private string $time; 
    private int $auditoriumId; 
    private int $movieId; 
    
    protected static string $table = "showings";

    public function __construct(array $data){
        $this->showingId = $data["showing_id"];
        $this->time = $data["time"];
        $this->auditoriumId = $data["auditorium_id"];
        $this->movieId = $data["movie_id"];
    }

    public function getShowingId(): int {
        return $this->showingId;
    }

    public function getTime(): string {
        return $this->time;
    }

    public function getAuditoriumId(): int {
        return $this->auditoriumId;
    }

    public function getMovieId(): int {
        return $this->MovieId;
    }

    public function setTime(string $time){
        $this->time = $time;
    }

    public function setAuditoriumId(int $auditoriumId){
        $this->auditoriumId = $cardNb;
    }

    public function setMovieId(int $movieId){
        $this->movieId = $movieId;
    }

    public function toArray(){
        return [$this->showingId, $this->time, $this->audtoriumId, $this->movieId];
    }
    
}