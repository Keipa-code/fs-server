import React from "react";
import Dropzone from './Uppy/Dropzone'

function Home() {
  return (
    <div>
      <div className="container-fluid bg-primary d-flex">
        <h1 className="text-light p-2 bd-highlight">FS-Server</h1>
        <form className="col-2 ms-auto p-2 bd-highlight">
          <input className="form-control mt-2" id="search" name="search" type="search" placeholder="Поиск" />
        </form>
      </div>
      <div className="position-absolute top-50 start-50 translate-middle">
        <Dropzone />
      </div>
    </div>
  )
}

export default Home