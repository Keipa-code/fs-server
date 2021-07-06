import React, { useState } from 'react'
import Dropzone from './Uppy/Dropzone'
import { Redirect } from 'react-router-dom'
import URLQueryEncode from '../Api/URLQueryEncode'

function Home() {
  const [formData, setFormData] = useState('')

  const [errors, setErrors] = useState({})
  const [submitted, setSubmitted] = useState(false)
  const [path, setPath] = useState('')

  const handleChange = (event) => {
    setFormData(event.target.value)
  }

  const handleSubmit = (event) => {
    event.preventDefault()
    setErrors({})

    setPath('?query=' + URLQueryEncode(formData))
    setSubmitted(true)
  }

  if (submitted) {
    return (
      <Redirect
        push
        to={{
          pathname: '/search/',
          search: path !== '?query=' ? path : '',
        }}
      />
    )
  }

  return (
    <div>
      <div className="container-fluid bg-primary d-flex">
        <h1 className="text-light p-2 bd-highlight">FS-Server</h1>
        <form
          className="form row g-3 ms-auto p-2 bd-highlight"
          onSubmit={handleSubmit}
        >
          <div className="col-auto">
            <input
              className="form-control mt-2 col-3"
              id="query"
              name="query"
              type="search"
              placeholder="Поиск"
              value={formData}
              onChange={handleChange}
            />
            {errors.search ? (
              <div className="input-error">{errors.search}</div>
            ) : null}
          </div>
          <div className="col-auto">
            <button
              type="submit"
              className="mt-2 p-2 bd-highlight btn btn-secondary"
            >
              Поиск
            </button>
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
