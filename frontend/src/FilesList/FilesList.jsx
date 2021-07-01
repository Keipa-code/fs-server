import React, {useState, useEffect} from "react";
import {useLocation} from "react-router-dom";
import "./FilesList.css";

function useQuery() {
  return new URLSearchParams(useLocation().search)
}

function FilesList() {
  const [errors, setErrors] = useState('')
  const [formData, setFormData] = useState('')
  const [queryString, setQueryString] = useState({
    query: formData,
    sort: '',
    order: '',
    page: '',
  })
  const query = useQuery()
  let previewLink = "/var/www/frontend/public/logo192.png"
  let downloadLink = "#"


  const handleSelectChange = (event) => {
    setQueryString({
      sort: event.target.name,
      order: event.target.value,
    })
  }

  const handleFormChange = (event) => {
    setFormData({
      [event.target.name]: event.target.value
    })
  }

  const handleSubmit = (event) => {
    event.preventDefault()
  }

  return (
    <div className="container">
      <h3 className="my-xl-4">Результаты по запросу: {query.get("query")}</h3>
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
            <div className="input-error">
              {errors.search}
            </div>
          ) : null}
          <button type="submit" className="btn btn-secondary p-2 m-2 bd-highlight">Поиск</button>

        </form>
        <div className="d-flex flex-row bd-highlight mt-5">
          <select className="form-select w-auto" onChange={handleSelectChange}>
            <option selected disabled>Сортировка</option>
            <option name="date" value="DESC">Сначала новые</option>
            <option name="date" value="ASC">Сначала старые</option>
            <option name="name" value="ASC">По названию файла (А-Я)</option>
            <option name="name" value="DESC">По названию файла (Я-А)</option>
            <option name="size" value="ASC">По размеру файла (возрастание)</option>
            <option name="size" value="DESC">По размеру файла (уменьшение)</option>
          </select>
        </div>

      </div>
      <div className="container border mt-4 p-3">
        <h3 className="align-content-start">Filename</h3>
        {previewLink ? (<img className="my-3" src={previewLink} alt="123"/>) : null}
        <table className="table table-striped table-hover table-bordered">
          <tbody>
          <tr className="d-flex flex-wrap">
            <td className="col-2 p-2 flex-fill bd-highlight">Формат файла</td>
            <td className="col-2 p-2 flex-fill bd-highlight">Jpeg</td>
          </tr>
          </tbody>
        </table>
        <div className="file-info border">
          <div>
            <b>Пароль 123.rar</b>
            <i className="nowrap">(836,3 КБ)</i>
          </div>
          <div className="file-info__time">
            Загружен
            <time dateTime="2020-09-24 15:15:34 UTC"> 9 месяцев назад</time>
          </div>
        </div>
        <a className="btn-primary btn mt-3" href={downloadLink}>Скачать</a>
      </div>

      <nav className="mt-2 mb-5" aria-label="Page navigation">
        <ul className="pagination">
          <li className="page-item"><a className="page-link" href="#">Previous</a></li>
          <li className="page-item"><a className="page-link" href="#">1</a></li>
          <li className="page-item"><a className="page-link" href="#">2</a></li>
          <li className="page-item"><a className="page-link" href="#">3</a></li>
          <li className="page-item"><a className="page-link" href="#">4</a></li>
          <li className="page-item"><a className="page-link" href="#">Next</a></li>
        </ul>
      </nav>
    </div>
  )
}

export default FilesList