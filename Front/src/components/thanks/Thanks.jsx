import React from 'react';
import './thanks.css';
import logoblanco from '../images/logoblanco.png';

function Thanks() {
    return (
        <div className="contenedor">
            <img src={logoblanco} alt="Logo de la empresa" />
            <div className="bocadillo">
                <p>¡Gracias por tu ayuda aventurer@!</p>
            </div>
        </div>
    );

}

export default Thanks;