/**
 * @author Nicolas CARPi <nico-git@deltablot.email>
 * @copyright 2012 Nicolas CARPi
 * @see https://www.elabftw.net Official website
 * @license AGPL-3.0
 * @package elabftw
 */
import { Payload, Method, Model, Action, Target, ResponseMsg } from './interfaces';
import { Ajax } from './Ajax.class';

export default class TeamGroup {

  model: Model;
  sender: Ajax;

  constructor() {
    this.model = Model.TeamGroup,
    this.sender = new Ajax();
  }

  create(content: string): Promise<ResponseMsg> {
    const payload: Payload = {
      method: Method.POST,
      action: Action.Create,
      model: this.model,
      content: content,
    };
    return this.sender.send(payload);
  }

  update(user: number, group: string, how: string): Promise<ResponseMsg> {
    const payload: Payload = {
      method: Method.POST,
      action: Action.Update,
      model: this.model,
      target: Target.Member,
      extraParams: {
        userid: user,
        group: group,
        how: how,
      },
    };
    return this.sender.send(payload);
  }

  destroy(id: number): Promise<ResponseMsg> {
    const payload: Payload = {
      method: Method.POST,
      action: Action.Destroy,
      model: this.model,
      id : id,
    };
    return this.sender.send(payload);
  }
}
