import React from 'react';
import {Col, Image} from "react-bootstrap";
import {sizeString} from './filesize'

function FileItem({file}) {
  return (
    <div className="container border mt-4 p-3">
      <h3 className="align-content-start">Filename</h3>
      {file.fileInfo.previewLink ? <Image width={300} {file.fileInfo.previewLink}/> : null}
      <table className="table table-striped table-hover table-bordered">
        <tbody>
        <tr className="d-flex flex-wrap">
          <td className="col-2 p-2 flex-fill bd-highlight">Формат файла</td>
          <td className="col-2 p-2 flex-fill bd-highlight">{file.fileInfo.fileFormat}</td>
        </tr>
        {file.fileInfo.resolution ?? (<tr className="d-flex flex-wrap">
          <td className="col-2 p-2 flex-fill bd-highlight">Разрешение</td>
          <td className="col-2 p-2 flex-fill bd-highlight">{file.fileInfo.resolution}</td>
        </tr>)}
        {file.fileInfo.codec ?? (<tr className="d-flex flex-wrap">
          <td className="col-2 p-2 flex-fill bd-highlight">Кодек</td>
          <td className="col-2 p-2 flex-fill bd-highlight">{file.fileInfo.codec}</td>
        </tr>)}
        {file.fileInfo.playTime ?? (<tr className="d-flex flex-wrap">
          <td className="col-2 p-2 flex-fill bd-highlight">Продолжительность</td>
          <td className="col-2 p-2 flex-fill bd-highlight">{file.fileInfo.playTime}</td>
        </tr>)}
        </tbody>
      </table>
      <div className="file-info border">
        <div>
          <b>{file.filename}</b>
          <i className="nowrap">{sizeString(file.fileInfo.size)}</i>
        </div>
        <div className="file-info__time">
          Загружен
          <time dateTime={file.date}> {file.date}</time>
        </div>
      </div>
      <a className="btn-primary btn mt-3" href={file.uuidLink}>Скачать</a>
    </div>
  )
}

export default FileItem