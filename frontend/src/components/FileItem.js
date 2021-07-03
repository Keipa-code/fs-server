import React from 'react'
import { Image } from 'react-bootstrap'
import { sizeString } from './filesize'

const FileItem = ({ file }) => {
  const fileInfo = JSON.parse(file.fileInfo)
  return (
    <div className="container border mt-4 p-3">
      <h3 className="align-content-start my-3">{file.filename}</h3>
      {file.previewLink ? <Image width={300} src={'/api' + file.previewLink} /> : null}
      <table className="table table-striped table-hover table-bordered">
        <tbody>
          <tr className="d-flex flex-wrap mt-3">
            <td className="col-2 p-2 flex-fill bd-highlight">Формат файла</td>
            <td className="col-2 p-2 flex-fill bd-highlight">
              {fileInfo.fileFormat}
            </td>
          </tr>
          {fileInfo.resolution ? (
            <tr className="d-flex flex-wrap">
              <td className="col-2 p-2 flex-fill bd-highlight">Разрешение</td>
              <td className="col-2 p-2 flex-fill bd-highlight">
                {fileInfo.resolution}
              </td>
            </tr>
          ) : null}
          {fileInfo.codec ? (
            <tr className="d-flex flex-wrap">
              <td className="col-2 p-2 flex-fill bd-highlight">Кодек</td>
              <td className="col-2 p-2 flex-fill bd-highlight">
                {fileInfo.codec}
              </td>
            </tr>
          ) : null}
          {fileInfo.playTime ? (
            <tr className="d-flex flex-wrap">
              <td className="col-2 p-2 flex-fill bd-highlight">
                Продолжительность
              </td>
              <td className="col-2 p-2 flex-fill bd-highlight">
                {fileInfo.playTime}
              </td>
            </tr>
          ) : null}
        </tbody>
      </table>
      <div className="file-info border mt-5">
        <div>
          <b>{file.filename}</b>
          <i className="nowrap">{sizeString(fileInfo.size)}</i>
        </div>
        <div className="file-info__time">
          Загружен
          <time dateTime={file.date.date}> {file.date.date}</time>
        </div>
      </div>
      <a className="btn-primary btn mt-3" href={'/api/upload/' + file.uuidLink}>
        Скачать
      </a>
    </div>
  )
}

export default FileItem
