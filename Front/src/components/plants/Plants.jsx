import React, { useState, useEffect } from "react";

function Plants() {

    const [plants, setRepo] = useState([]);


    useEffect(() => {
        fetch('http://127.0.0.1:8000/plants/list')
            .then(response => response.json())
            .then(plants => setRepo(plants))
            .catch(error => console.error(error));
    }, []);

    const [likes, setLikes] = useState(new Array(plants.length).fill(false));


    const handleLike = (index) => {
        setLikes((prevLikes) => {
            const newLikes = [...prevLikes];
            newLikes[index] = !newLikes[index];
            return newLikes;
        });
    };

return (
    <>
    <div className="container px-4 py-5" id="hanging-icons">
        <h2 className="pb-2 border-bottom">Plantas</h2>
        <div className="row">
            {plants.map((int, index) => (
                <div className="col-lg-6 mb-4">
                    <div className="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg cosa">
                        <div className="row no-gutters" key={int.id}>
                            <div className="col-md-4 col-12" style={{ textAlign: "center" }}>
                                <img
                                    src={int.image}
                                    className="bi mt-2 mb-2 w-100 card-img"
                                    style={{
                                        maxWidth: "300px",
                                        height: "auto",
                                        marginLeft: "10px",
                                    }}
                                    alt={int.name}
                                />
                                    
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="40"
                                    height="40"
                                    fill={likes[index] ? "red" : "grey"}
                                    className="bi bi-suit-heart-fill"
                                    viewBox="0 0 16 16"
                                    onClick={() => handleLike(index)}>
                                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z" />
                                </svg>
                            </div>
                            <div className="col-md-8">
                                <div className="card-body">
                                    <h5 className="card-title">
                                        {int.name}
                                    </h5>
                                    <p className="card-text">
                                        {int.description}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ))}
        </div>
        <a href={"#"}
            className="btn btn-primary"
            role="button"
            data-bs-toggle="button"
            // onClick={handleSendData}
        >Envía tus datos</a>
    </div>
</>
);
}

export default Plants
