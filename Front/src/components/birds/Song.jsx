import React, { useState, useRef } from 'react';
import { FaMicrophone, FaMicrophoneSlash } from 'react-icons/fa';

import './song.css';

function Song(props) {


    //función para que suene el canto
    const [playing, setPlaying] = useState(false);
    const audioRef = useRef(null);

    function togglePlaying() {
        if (playing) {
            audioRef.current.pause();
        } else {
            audioRef.current.play();
        }
        setPlaying(!playing);
    };

    return (
        <>
                <div className="mini-player" >
                    <button className={`play ${playing ? 'playing' : ''}`} onClick={togglePlaying}>
                        {playing ? <FaMicrophone /> : <FaMicrophoneSlash />}
                    </button>                   
                    <div className="audio-container"  >
                        <audio ref={audioRef}  className="audio" >
                            <source type="audio/mp3" src={props.song} />
                        </audio>
                    </div>

                </div>
        </>
    );

}

export default Song;


//     function Song({ songUrl }) {
//         const [playing, setPlaying] = useState(false);
//         const audioRef = useRef(null);
    
//         function togglePlaying() {
//             if (playing) {
//                 audioRef.current.pause();
//             } else {
//                 audioRef.current.play();
//             }
//             setPlaying(!playing);
//         };
    
//         return (
//             <div className="mini-player">
//                 <button className={`play ${playing ? 'playing' : ''}`} onClick={togglePlaying}>
//                     {playing ? <FaMicrophoneSlash /> : <FaMicrophone />}
//                 </button>
//                 <div className="audio-container" >
//                     <audio ref={audioRef} className="audio" >
//                         <source src={songUrl} type="audio/mp3" />
//                     </audio>
//                 </div>
//             </div>
//         );
//     }
    


// export default Song;


// intento 3
// function Song() {
// const [repo, setRepo] = useState([]);
// useEffect(() => {
//     fetch('http://127.0.0.1:8000/birds/list')
//         .then(response => response.json())
//         .then(repo => setRepo(repo))
//         .catch(error => console.error(error));
// }, []);

// //función para que suene el canto
// const [playing, setPlaying] = useState(false);
// const [audioElements, setAudioElements] = useState([]);

// function togglePlaying(index) {
//     if (audioElements[index].paused) {
//         audioElements.forEach((audio) => audio.pause());
//         audioElements[index].play();
//         setPlaying(true);
//     } else {
//         audioElements[index].pause();
//         setPlaying(false);
//     }
// };

// useEffect(() => {
//     setAudioElements(repo.map((int) => {
//         const audioElement = new Audio(int.song);
//         audioElement.addEventListener('ended', () => {
//             setPlaying(false);
//         });
//         return audioElement;
//     }));
// }, [repo]);

// return (
//     <>
//         <div className="mini-player">
//             <button className={`play ${playing ? 'playing' : ''}`} onClick={() => togglePlaying(0)}>
//                 {playing ? <FaMicrophoneSlash /> : <FaMicrophone />}
//             </button>
//             {repo.map((int, index) => (
//                 <div key={int.id} className="audio-container">
//                     <button className={`play ${playing ? 'playing' : ''}`} onClick={() => togglePlaying(index)}>
//                         {playing ? <FaMicrophoneSlash /> : <FaMicrophone />}
//                     </button>
//                 </div>
//             ))}
//         </div>
//     </>
// );
