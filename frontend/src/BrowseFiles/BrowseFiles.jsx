import React, { useState, useEffect, useContext } from 'react'
import { useLocation, useHistory } from 'react-router-dom'
import './BrowseFiles.css'
import api from '../Api/Api'
import URLQueryEncode from '../Api/URLQueryEncode'
import { Context } from '../index'
import Pages from '../components/Pages'
import FilesList from '../components/FilesList'
import Selector from '../components/Selector'
import { observer } from 'mobx-react-lite'

function useQuery() {
  return new URLSearchParams(useLocation().search)
}

const BrowseFiles = observer(() => {
  const { file } = useContext(Context)
  const query = useQuery()
  const history = useHistory()
  const [formData, setFormData] = useState('')
  const [errors, setErrors] = useState({})
  const [submitted, setSubmitted] = useState(false)

  if (!submitted) {
    api.get('/find' + '?' + query.toString()).then((data) => {
      file.setFiles(data)
    })
    setFormData(query.get('query') ? query.get('query') : '')
    api
      .post('/getrowcount', {
        query: formData,
      })
      .then((data) => {
        file.setTotalCount(data)
      })
    setSubmitted(true)
    window.scrollTo(0, 0)
  }

  const handleFormChange = (event) => {
    setFormData(event.target.value)
  }

  useEffect(() => {
    if (query.get('page') !== file.page) {
      if (file.sorting.sort !== undefined) {
        query.set('sort', file.sorting.sort)
      }
      if (file.sorting.order !== undefined) {
        query.set('order', file.sorting.order)
      }
      if (query.has('page') || file.page > 1) query.set('page', file.page)
      history.push(
        '/search' + (query.toString().length > 0 ? '?' + query.toString() : '')
      )
      setSubmitted(false)
    }
  }, [file.sorting, file.page])

  const handleSubmit = (event) => {
    event.preventDefault()

    setErrors({})

    api
      .post('/getrowcount', {
        query: formData,
      })
      .then((data) => {
        file.setTotalCount(data)
      })
    query.set('query', URLQueryEncode(formData))
    history.push(
      '/search' + (query.toString().length > 0 ? '?' + query.toString() : '')
    )
    setSubmitted(false)
  }

  return (
    <div className="container">
      <h3 className="my-4">Результаты по запросу: {query.get('query')}</h3>
      <div className="row justify-content-center">
        <form className="d-flex" onSubmit={handleSubmit}>
          <input
            className="form-control p-2 my-2 bd-highlight"
            id="query"
            name="query"
            type="search"
            placeholder="Поиск"
            value={formData}
            onChange={handleFormChange}
          />
          {errors.search ? (
            <div className="input-error">{errors.search}</div>
          ) : null}
          <button
            type="submit"
            className="btn btn-primary p-2 m-2 bd-highlight"
          >
            Поиск
          </button>
        </form>
        <Selector />
      </div>

      <FilesList />
      <Pages />
    </div>
  )
})

export default BrowseFiles
