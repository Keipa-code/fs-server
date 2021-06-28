import React, { useState } from "react";
import Dropzone from './Uppy/Dropzone'
import api from "../Api/Api";
import { Redirect } from "react-router-dom";

function Home() {
  const [formData, setFormData] = useState({
    searchValue: '',
  })

  const [errors, setErrors] = useState({})



  const handleChange = (event) => {
    setFormData({
      [event.target.name]: event.target.value
    })
  }

  const handleSubmit = (event) => {
    event.preventDefault()
    setErrors({})
    api
      .post('/find', {
        searchValue: formData.searchValue
      })
      .then((response) => {
        if(response.ok) {
          return <Redirect to="/search" push={false} />
        }
      })

      .catch(async (error) => {
        if(error.status === 422) {
          const data = await error.json()
          setErrors(data.errors)
        }
      })
  }

  return (
    <div>
      <div className="container-fluid bg-primary d-flex">
        <h1 className="text-light p-2 bd-highlight">FS-Server</h1>
        <form className="form row g-3 ms-auto p-2 bd-highlight" method="post" onSubmit={handleSubmit}>
          <div className="col-auto">
          <input
            className="form-control mt-2 col-3"
            id="searchValue"
            name="searchValue"
            type="search"
            placeholder="Поиск"
            value={formData.searchValue}
            onChange={handleChange}
          />
          {errors.search ? (
            <div className="input-error">
              {errors.search}
            </div>
          ) : null}
          </div>
          <div className="col-auto">
          <button type="submit" className="mt-2 p-2 bd-highlight btn btn-secondary">Поиск</button>
          </div>
        </form>
      </div>
      <div className="offset-xl-3 col-md-6">
        <Dropzone />
      </div>
    </div>
  )
}

export default Home